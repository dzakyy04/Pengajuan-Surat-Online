<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\SuratTidakMampu;
use App\Mail\PengajuanDitolakMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\TemplateProcessor;

class SktmController extends Controller
{
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

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $pengajuanList = $query->orderBy('created_at', 'desc')->paginate(10);
        $pengajuanList->appends(['status' => $request->status]);

        $pendingSktm = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKTM');
        })->where('status', 'pending')->count();

        $diprosesSktm = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKTM');
        })->where('status', 'diproses')->count();

        $ditolakSktm = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKTM');
        })->where('status', 'ditolak')->count();

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

        return view('admin.surat.sktm.index', compact(
            'pengajuanList',
            'pendingSktm',
            'diprosesSktm',
            'ditolakSktm'
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
            if ($pengajuan->status === 'diproses' && $pengajuan->file_surat_cetak) {
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal. Periksa kembali data yang diinput.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', 'Data SKTM tidak ditemukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update SKTM: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    private function regenerateFile($pengajuan, $sktm)
    {
        $data = [
            'nomor_surat' => $pengajuan->nomor_surat,
            'tanggal_surat' => now()->translatedFormat('d F Y'),
            'hari_ini' => now()->translatedFormat('d F Y'),
            'nama' => $sktm->nama,
            'nik' => $sktm->nik,
            'tempat_lahir' => $sktm->tempat_lahir,
            'tanggal_lahir' => \Carbon\Carbon::parse($sktm->tanggal_lahir)->translatedFormat('d F Y'),
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
            'tanggal_surat_rt' => \Carbon\Carbon::parse($sktm->tanggal_surat_rt)->translatedFormat('d F Y'),
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
            $keperluanInline = trim(
                preg_replace('/\s+/', ' ', strip_tags($data['keperluan_html']))
            );
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

        $outputPath = storage_path('app/surat/sktm/' . $pengajuan->file_surat_cetak);
        $templateProcessor->saveAs($outputPath);

        $pengajuan->update([
            'tanggal_cetak' => now(),
        ]);
    }

    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);
            $sktm = SuratTidakMampu::where('pengajuan_surat_id', $id)->firstOrFail();
            $jenisSurat = $pengajuan->jenisSurat;

            $nomorSurat = $this->generateNomorSurat($jenisSurat);

            $data = [
                'nomor_surat' => $nomorSurat,
                'tanggal_surat' => now()->translatedFormat('d F Y'),
                'hari_ini' => now()->translatedFormat('d F Y'),
                'nama' => $sktm->nama,
                'nik' => $sktm->nik,
                'tempat_lahir' => $sktm->tempat_lahir,
                'tanggal_lahir' => \Carbon\Carbon::parse($sktm->tanggal_lahir)->translatedFormat('d F Y'),
                'jenis_kelamin' => $sktm->jenis_kelamin,
                'bangsa_agama' => 'Indonesia / ' . $sktm->agama,
                'status_perkawinan' => $sktm->status_perkawinan,
                'rt' => $sktm->rt,
                'rw' => $sktm->rw,
                'dusun' => $sktm->dusun,
                'pekerjaan' => $sktm->pekerjaan,
                'alamat' => $sktm->alamat . ' RT ' . $sktm->rt . '/RW ' . $sktm->rw .
                    ($sktm->dusun ? ', Dusun ' . $sktm->dusun : '') .
                    ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
                'no_surat_rt' => $sktm->no_surat_rt,
                'tanggal_surat_rt' => \Carbon\Carbon::parse($sktm->tanggal_surat_rt)->translatedFormat('d F Y'),
                'keperluan_html' => $sktm->keperluan,
            ];

            $templatePath = resource_path('files/surat-keterangan-miskin.docx');

            if (!file_exists($templatePath)) {
                throw new \Exception('Template DOCX tidak ditemukan di: ' . $templatePath);
            }

            $templateProcessor = new TemplateProcessor($templatePath);

            foreach ($data as $key => $value) {
                if ($key !== 'keperluan_html') {
                    $templateProcessor->setValue($key, $value);
                }
            }

            if (!empty($data['keperluan_html'])) {
                $keperluanInline = trim(
                    preg_replace('/\s+/', ' ', strip_tags($data['keperluan_html']))
                );
                $templateProcessor->setValue('keperluan', $keperluanInline);
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

            $filename = 'SKTM_' . $sktm->nik . '_' . $sktm->nama . '.docx';
            $outputPath = storage_path('app/surat/sktm/' . $filename);

            if (!file_exists(storage_path('app/surat/sktm'))) {
                mkdir(storage_path('app/surat/sktm'), 0755, true);
            }

            $templateProcessor->saveAs($outputPath);

            $pengajuan->update([
                'status' => 'diproses',
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
            Log::error('Error approve SKTM: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
                'status' => 'ditolak',
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

    public function uploadTtd(Request $request, $id)
    {
        $request->validate([
            'file_ttd' => 'required|file|mimes:pdf,docx|max:5120',
        ]);

        try {
            $pengajuan = PengajuanSurat::findOrFail($id);

            $directory = 'arsip/sktm';

            // Hapus file lama jika ada
            if (
                $pengajuan->file_surat_ttd &&
                Storage::exists($directory . '/' . $pengajuan->file_surat_ttd)
            ) {
                Storage::delete($directory . '/' . $pengajuan->file_surat_ttd);
            }

            $file = $request->file('file_ttd');
            $filename = 'TTD_' . $pengajuan->nomor_pengajuan . '_' . $pengajuan->nama . '.' . $file->getClientOriginalExtension();

            // Simpan ke storage/app/arsip/sktm
            $file->storeAs($directory, $filename);

            $pengajuan->update([
                'file_surat_ttd' => $filename,
                'tanggal_upload_ttd' => now(),
            ]);

            return back()->with('success', 'File surat yang sudah ditandatangani berhasil diupload!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload file: ' . $e->getMessage());
        }
    }

    public function success($file)
    {
        $filePath = storage_path('app/surat/sktm/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return view('admin.surat.sktm.success', compact('file'));
    }

    public function download($file)
    {
        $filePath = storage_path('app/surat/sktm/' . $file);

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

            $filePath = storage_path('app/public/surat_ttd/' . $pengajuan->file_surat_ttd);

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
        $tahunSekarang = date('Y');

        if ($jenisSurat->tahun_counter != $tahunSekarang) {
            $jenisSurat->counter_terakhir = 0;
            $jenisSurat->tahun_counter = $tahunSekarang;
        }

        $jenisSurat->counter_terakhir += 1;
        $jenisSurat->save();

        $nomorUrut = str_pad($jenisSurat->counter_terakhir, 3, '0', STR_PAD_LEFT);
        $nomorSurat = str_replace(
            ['[NO]', '[TAHUN]'],
            [$nomorUrut, $tahunSekarang],
            $jenisSurat->format_nomor
        );

        return $nomorSurat;
    }
}
