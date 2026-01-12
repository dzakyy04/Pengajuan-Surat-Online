<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\SuratTidakMampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
use App\Mail\PengajuanDitolakMail;
use App\Mail\PengajuanSelesaiMail;
use Carbon\Carbon;

class SktmController extends Controller
{
    private const PATH_SURAT_CETAK = 'surat/cetak';
    private const PATH_SURAT_TTD = 'surat/ttd';

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $query = PengajuanSurat::with(['jenisSurat', 'admin'])
            ->whereHas('jenisSurat', function ($q) {
                $q->where('kode', 'SKTM');
            });

        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::today()->startOfDay();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::today()->endOfDay();

        $query->whereBetween('created_at', [$startDate, $endDate]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nomor_pengajuan', 'like', "%{$search}%")
                  ->orWhere('email_pemohon', 'like', "%{$search}%")
                  ->orWhere('no_hp_pemohon', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuanList = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $baseCount = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKTM');
        })->whereBetween('created_at', [$startDate, $endDate]);

        $submittedSktm = (clone $baseCount)->where('status', 'submitted')->count();
        $verifiedSktm  = (clone $baseCount)->where('status', 'verified')->count();
        $approvedSktm  = (clone $baseCount)->where('status', 'approved')->count();
        $notifiedSktm  = (clone $baseCount)->where('status', 'notified')->count();
        $rejectedSktm  = (clone $baseCount)->where('status', 'rejected')->count();

        return view('admin.surat.sktm.index', compact(
            'pengajuanList',
            'submittedSktm',
            'verifiedSktm',
            'approvedSktm',
            'notifiedSktm',
            'rejectedSktm'
        ));
    }

    public function detail($id)
    {
        $pengajuan = PengajuanSurat::with(['jenisSurat', 'admin'])->findOrFail($id);
        $sktm = SuratTidakMampu::where('pengajuan_surat_id', $id)->firstOrFail();
        $anggotaKeluarga = $sktm->anggota_keluarga ?? [];

        return view('admin.surat.sktm.detail', compact('pengajuan', 'sktm', 'anggotaKeluarga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'dusun' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'no_surat_rt' => 'required|string|max:50',
            'tanggal_surat_rt' => 'required|date',
            'keperluan' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);
            $sktm = SuratTidakMampu::where('pengajuan_surat_id', $id)->firstOrFail();

            $sktm->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'status_perkawinan' => $request->status_perkawinan,
                'pekerjaan' => $request->pekerjaan,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'dusun' => $request->dusun,
                'alamat' => $request->alamat,
                'no_surat_rt' => $request->no_surat_rt,
                'tanggal_surat_rt' => $request->tanggal_surat_rt,
                'keperluan' => $request->keperluan,
            ]);

            $fileRegenerated = false;
            if (in_array($pengajuan->status, ['verified', 'approved']) && $pengajuan->file_surat_cetak) {
                $this->regenerateFile($pengajuan, $sktm);
                $fileRegenerated = true;
            }

            DB::commit();

            $message = 'Data SKTM berhasil diperbarui.';
            if ($fileRegenerated) {
                $message .= ' File surat telah di-generate ulang dengan data terbaru.';
            }

            return redirect()
                ->route('admin.sktm.detail', $id)
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update SKTM: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    public function verify(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);

            if ($pengajuan->status !== 'submitted') {
                return back()->with('error', 'Pengajuan ini tidak dalam status submitted.');
            }

            $sktm = SuratTidakMampu::where('pengajuan_surat_id', $id)->firstOrFail();
            $jenisSurat = $pengajuan->jenisSurat;

            $nomorSurat = $this->generateNomorSurat($jenisSurat);
            $filename = $this->generateSuratFile($pengajuan, $sktm, $nomorSurat);

            $pengajuan->update([
                'status' => 'verified',
                'nomor_surat' => $nomorSurat,
                'admin_id' => Auth::guard('admin')->id(),
                'tanggal_diproses' => now(),
                'file_surat_cetak' => $filename,
                'tanggal_cetak' => now(),
            ]);

            DB::commit();

            return redirect()->route('admin.sktm.success', $filename)
                ->with('success', 'Surat berhasil disetujui dan dicetak!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error verify SKTM: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function uploadTtd(Request $request, $id)
    {
        $request->validate([
            'file_ttd' => 'required|file|mimes:pdf,docx|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);

            if (!in_array($pengajuan->status, ['verified', 'approved'])) {
                return back()->with('error', 'Hanya surat yang sudah diverifikasi atau disetujui yang bisa di-upload TTD.');
            }

            // Pastikan folder ttd ada
            $dir = storage_path('app/' . self::PATH_SURAT_TTD);
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            // Hapus file lama jika ada
            if ($pengajuan->file_surat_ttd) {
                $oldPath = storage_path('app/' . self::PATH_SURAT_TTD . '/' . $pengajuan->file_surat_ttd);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('file_ttd');
            $filename = 'TTD_' . $pengajuan->nomor_pengajuan . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan ke folder ttd
            $file->move($dir, $filename);

            $pengajuan->update([
                'file_surat_ttd' => $filename,
                'tanggal_upload_ttd' => now(),
                'status' => 'approved',
            ]);

            DB::commit();

            return back()->with('success', 'File surat bertanda tangan berhasil diupload! Status berubah menjadi Diverifikasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal upload file: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);

            $pengajuan->update([
                'status' => 'rejected',
                'admin_id' => Auth::guard('admin')->id(),
                'catatan_admin' => $request->catatan_admin,
                'tanggal_diproses' => now(),
            ]);

            try {
                Mail::to($pengajuan->email_pemohon)->send(
                    new PengajuanDitolakMail($pengajuan, $request->catatan_admin)
                );
            } catch (\Exception $mailError) {
                Log::error('Gagal mengirim email penolakan: ' . $mailError->getMessage());
            }

            DB::commit();

            return redirect()->route('admin.sktm.index')
                ->with('success', 'Pengajuan berhasil ditolak. Notifikasi telah dikirim ke pemohon.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function sendNotification($id)
    {
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);

            // Validasi status harus approved dan sudah ada file TTD
            if ($pengajuan->status !== 'approved') {
                return back()->with('error', 'Hanya pengajuan dengan status Approved yang dapat dikirim notifikasi.');
            }

            if (!$pengajuan->file_surat_ttd) {
                return back()->with('error', 'File surat bertanda tangan belum tersedia. Upload file TTD terlebih dahulu.');
            }

            // Cek apakah file TTD benar-benar ada
            $filePath = storage_path('app/' . self::PATH_SURAT_TTD . '/' . $pengajuan->file_surat_ttd);
            if (!file_exists($filePath)) {
                return back()->with('error', 'File surat bertanda tangan tidak ditemukan di server.');
            }

            // Kirim email
            try {
                Mail::to($pengajuan->email_pemohon)->send(
                    new PengajuanSelesaiMail($pengajuan)
                );
            } catch (\Exception $mailError) {
                Log::error('Gagal mengirim email notifikasi: ' . $mailError->getMessage());
                throw new \Exception('Gagal mengirim email: ' . $mailError->getMessage());
            }

            // Update status menjadi notified dan catat waktu notifikasi
            $pengajuan->update([
                'status' => 'notified',
                'tanggal_notifikasi_warga' => now(),
            ]);

            DB::commit();

            return back()->with('success', 'Notifikasi berhasil dikirim ke ' . $pengajuan->email_pemohon . '. Status berubah menjadi Dinotifikasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error send notification SKTM: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateSuratFile($pengajuan, $sktm, $nomorSurat)
    {
        $data = [
            'nomor_surat' => $nomorSurat,
            'tanggal_surat' => now()->format('d-m-Y'),
            'hari_ini' => now()->format('d-m-Y'),
            'nama' => $sktm->nama,
            'nik' => $sktm->nik,
            'tempat_lahir' => $sktm->tempat_lahir,
            'tanggal_lahir' => \Carbon\Carbon::parse($sktm->tanggal_lahir)->format('d-m-Y'),
            'jenis_kelamin' => $sktm->jenis_kelamin,
            'bangsa_agama' => 'Indonesia / ' . $sktm->agama,
            'status_perkawinan' => $sktm->status_perkawinan,
            'pekerjaan' => $sktm->pekerjaan,
            'rt' => $sktm->rt,
            'rw' => $sktm->rw,
            'dusun' => $sktm->dusun,
            'alamat' => $sktm->alamat . ' RT ' . $sktm->rt . '/RW ' . $sktm->rw .
                ($sktm->dusun ? ', Dusun ' . $sktm->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
            'no_surat_rt' => $sktm->no_surat_rt,
            'tanggal_surat_rt' => \Carbon\Carbon::parse($sktm->tanggal_surat_rt)->format('d-m-Y'),
            'keperluan_html' => $sktm->keperluan,
        ];

        $templatePath = resource_path('files/surat-keterangan-miskin.docx');

        if (!file_exists($templatePath)) {
            throw new \Exception('Template DOCX tidak ditemukan');
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            if ($key !== 'keperluan_html') {
                $templateProcessor->setValue($key, $value);
            }
        }

        if (!empty($data['keperluan_html'])) {
            $keperluanInline = trim(preg_replace('/\s+/', ' ', strip_tags($data['keperluan_html'])));
            $templateProcessor->setValue('keperluan', $keperluanInline);
        } else {
            $templateProcessor->setValue('keperluan', '-');
        }

        $anggotaKeluarga = $sktm->anggota_keluarga;

        if (!is_array($anggotaKeluarga)) {
            $anggotaKeluarga = [];
        }

        $textRun = new TextRun();
        $fontStyle = ['name' => 'Arial', 'size' => 12];

        if (!empty($anggotaKeluarga)) {
            foreach ($anggotaKeluarga as $index => $anggota) {
                $no = $index + 1;
                $nama = $anggota['nama'] ?? '-';
                $nik = $anggota['nik'] ?? '-';
                $textRun->addText("{$no}. {$nama} ({$nik})", $fontStyle);
                $textRun->addTextBreak();
            }
        } else {
            $textRun->addText('', $fontStyle);
        }

        $templateProcessor->setComplexBlock('anggota_keluarga_list', $textRun);

        $filename = 'SKTM_' . $sktm->nik . '_' . time() . '.docx';
        $outputPath = storage_path('app/' . self::PATH_SURAT_CETAK . '/' . $filename);

        // Pastikan folder cetak ada
        if (!file_exists(storage_path('app/' . self::PATH_SURAT_CETAK))) {
            mkdir(storage_path('app/' . self::PATH_SURAT_CETAK), 0755, true);
        }

        $templateProcessor->saveAs($outputPath);

        return $filename;
    }

    private function regenerateFile($pengajuan, $sktm)
    {
        $data = [
            'nomor_surat' => $pengajuan->nomor_surat,
            'tanggal_surat' => now()->format('d-m-Y'),
            'hari_ini' => now()->format('d-m-Y'),
            'nama' => $sktm->nama,
            'nik' => $sktm->nik,
            'tempat_lahir' => $sktm->tempat_lahir,
            'tanggal_lahir' => \Carbon\Carbon::parse($sktm->tanggal_lahir)->format('d-m-Y'),
            'jenis_kelamin' => $sktm->jenis_kelamin,
            'bangsa_agama' => 'Indonesia / ' . $sktm->agama,
            'status_perkawinan' => $sktm->status_perkawinan,
            'pekerjaan' => $sktm->pekerjaan,
            'rt' => $sktm->rt,
            'rw' => $sktm->rw,
            'dusun' => $sktm->dusun,
            'alamat' => $sktm->alamat . ' RT ' . $sktm->rt . '/RW ' . $sktm->rw .
                ($sktm->dusun ? ', Dusun ' . $sktm->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
            'no_surat_rt' => $sktm->no_surat_rt,
            'tanggal_surat_rt' => \Carbon\Carbon::parse($sktm->tanggal_surat_rt)->format('d-m-Y'),
            'keperluan_html' => $sktm->keperluan,
        ];

        $templatePath = resource_path('files/surat-keterangan-miskin.docx');

        if (!file_exists($templatePath)) {
            throw new \Exception('Template DOCX tidak ditemukan');
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            if ($key !== 'keperluan_html') {
                $templateProcessor->setValue($key, $value);
            }
        }

        if (!empty($data['keperluan_html'])) {
            $keperluanInline = trim(preg_replace('/\s+/', ' ', strip_tags($data['keperluan_html'])));
            $templateProcessor->setValue('keperluan', $keperluanInline);
        } else {
            $templateProcessor->setValue('keperluan', '-');
        }

        $anggotaKeluarga = $sktm->anggota_keluarga;

        if (!is_array($anggotaKeluarga)) {
            $anggotaKeluarga = [];
        }

        $textRun = new TextRun();
        $fontStyle = ['name' => 'Arial', 'size' => 12];

        if (!empty($anggotaKeluarga)) {
            foreach ($anggotaKeluarga as $index => $anggota) {
                $no = $index + 1;
                $nama = $anggota['nama'] ?? '-';
                $nik = $anggota['nik'] ?? '-';
                $textRun->addText("{$no}. {$nama} ({$nik})", $fontStyle);
                $textRun->addTextBreak();
            }
        } else {
            $textRun->addText('', $fontStyle);
        }

        $templateProcessor->setComplexBlock('anggota_keluarga_list', $textRun);

        // Regenerate file di folder cetak dengan nama file yang sama
        $outputPath = storage_path('app/' . self::PATH_SURAT_CETAK . '/' . $pengajuan->file_surat_cetak);
        $templateProcessor->saveAs($outputPath);

        $pengajuan->update(['tanggal_cetak' => now()]);
    }

    public function success($file)
    {
        $filePath = storage_path('app/' . self::PATH_SURAT_CETAK . '/' . $file);
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        return view('admin.surat.sktm.success', compact('file'));
    }

    public function download($file)
    {
        $filePath = storage_path('app/' . self::PATH_SURAT_CETAK . '/' . $file);
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        return response()->download($filePath);
    }

    public function downloadTtd($id)
    {
        try {
            $pengajuan = PengajuanSurat::findOrFail($id);

            if (!$pengajuan->file_surat_ttd) {
                return back()->with('error', 'File surat bertanda tangan belum tersedia.');
            }

            $filePath = storage_path('app/' . self::PATH_SURAT_TTD . '/' . $pengajuan->file_surat_ttd);

            if (!file_exists($filePath)) {
                return back()->with('error', 'File tidak ditemukan di server.');
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunduh file: ' . $e->getMessage());
        }
    }

    private function generateNomorSurat($jenisSurat)
    {
        $tahun = date('Y');

        DB::transaction(function () use ($jenisSurat, $tahun) {
            $jenisSurat->refresh();

            if ($jenisSurat->tahun_counter != $tahun) {
                $jenisSurat->counter_terakhir = 0;
                $jenisSurat->tahun_counter = $tahun;
            }

            $jenisSurat->counter_terakhir++;
            $jenisSurat->save();
        });

        do {
            $nomorUrut = str_pad($jenisSurat->counter_terakhir, 3, '0', STR_PAD_LEFT);

            $nomorSurat = str_replace(
                ['[NO]', '[TAHUN]'],
                [$nomorUrut, $tahun],
                $jenisSurat->format_nomor
            );

            $exists = PengajuanSurat::where('nomor_surat', $nomorSurat)->exists();

            if ($exists) {
                $jenisSurat->increment('counter_terakhir');
            }
        } while ($exists);

        return $nomorSurat;
    }
}
