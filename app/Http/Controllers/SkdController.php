<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\SuratDomisili;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Mail\PengajuanDitolakMail;

class SkdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $query = PengajuanSurat::with(['jenisSurat', 'admin'])
            ->whereHas('jenisSurat', function ($q) {
                $q->where('kode', 'SKD');
            });

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
            ->paginate(perPage: 10)
            ->withQueryString();

        $submittedSkd = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKD');
        })->where('status', 'submitted')->count();

        $verifiedSkd = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKD');
        })->where('status', 'verified')->count();

        $approvedSkd = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKD');
        })->where('status', 'approved')->count();

        $rejectedSkd = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKD');
        })->where('status', 'rejected')->count();

        return view('admin.surat.skd.index', compact(
            'pengajuanList',
            'submittedSkd',
            'verifiedSkd',
            'approvedSkd',
            'rejectedSkd'
        ));
    }

    public function detail($id)
    {
        $pengajuan = PengajuanSurat::with(['jenisSurat', 'admin'])->findOrFail($id);
        $skd = SuratDomisili::where('pengajuan_surat_id', $id)->firstOrFail();

        return view('admin.surat.skd.detail', compact('pengajuan', 'skd'));
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
            $skd = SuratDomisili::where('pengajuan_surat_id', $id)->firstOrFail();

            $skd->update([
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
                $this->regenerateFile($pengajuan, $skd);
                $fileRegenerated = true;
            }

            DB::commit();

            $message = 'Data SKD berhasil diperbarui.';
            if ($fileRegenerated) {
                $message .= ' File surat telah di-generate ulang dengan data terbaru.';
            }

            return redirect()
                ->route('admin.skd.detail', $id)
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update SKD: ' . $e->getMessage());
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

            $skd = SuratDomisili::where('pengajuan_surat_id', $id)->firstOrFail();
            $jenisSurat = $pengajuan->jenisSurat;

            $nomorSurat = $this->generateNomorSurat($jenisSurat);
            $filename = $this->generateSuratFile($pengajuan, $skd, $nomorSurat);

            $pengajuan->update([
                'status' => 'verified',
                'nomor_surat' => $nomorSurat,
                'admin_id' => Auth::guard('admin')->id(),
                'tanggal_diproses' => now(),
                'file_surat_cetak' => $filename,
                'tanggal_cetak' => now(),
            ]);

            DB::commit();

            // return redirect()->route('admin.skd.detail', $id)
            //     ->with('success', 'Pengajuan berhasil diverifikasi dan surat telah di-generate!');

            return redirect()->route('admin.skd.success', $filename)
                ->with('success', 'Surat berhasil disetujui dan dicetak!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error verify SKD: ' . $e->getMessage());
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


            if ($pengajuan->file_surat_ttd && Storage::disk('public')->exists('surat_ttd/' . $pengajuan->file_surat_ttd)) {
                Storage::disk('public')->delete('surat_ttd/' . $pengajuan->file_surat_ttd);
            }

            $file = $request->file('file_ttd');
            $filename = 'TTD_' . $pengajuan->nomor_pengajuan . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('surat_ttd', $filename, 'public');

            $pengajuan->update([
                'file_surat_ttd' => $filename,
                'tanggal_upload_ttd' => now(),
                'status' => 'approved',
            ]);

            DB::commit();

            return back()->with('success', 'File surat bertanda tangan berhasil diupload! Status berubah menjadi Approved.');
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

            return redirect()->route('admin.skd.index')
                ->with('success', 'Pengajuan berhasil ditolak. Notifikasi telah dikirim ke pemohon.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateSuratFile($pengajuan, $skd, $nomorSurat)
    {
        $tanggalBerlaku = now()->addDays(90);

        $data = [
            'nomor_surat' => $nomorSurat,
            'tanggal_surat' => now()->format('d-m-Y'),
            'tanggal_berlaku' => $tanggalBerlaku->format('d-m-Y'),
            'hari_ini' => now()->format('d-m-Y'),
            'nama' => $skd->nama,
            'nik' => $skd->nik,
            'tempat_lahir' => $skd->tempat_lahir,
            'tanggal_lahir' => \Carbon\Carbon::parse($skd->tanggal_lahir)->format('d-m-Y'),
            'jenis_kelamin' => $skd->jenis_kelamin,
            'bangsa_agama' => 'Indonesia / ' . $skd->agama,
            'status_perkawinan' => $skd->status_perkawinan,
            'rt' => $skd->rt,
            'rw' => $skd->rw,
            'dusun' => $skd->dusun,
            'pekerjaan' => $skd->pekerjaan,
            'alamat' => $skd->alamat . ' RT ' . $skd->rt . '/RW ' . $skd->rw .
                ($skd->dusun ? ', Dusun ' . $skd->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
            'no_surat_rt' => $skd->no_surat_rt,
            'tanggal_surat_rt' => \Carbon\Carbon::parse($skd->tanggal_surat_rt)->format('d-m-Y'),
            'keperluan_html' => $skd->keperluan,
        ];

        $templatePath = resource_path('files/surat-domisili.docx');

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
        }

        $filename = 'SKD_' . $skd->nik . '_' . time() . '.docx';
        $outputPath = storage_path('app/surat/skd/' . $filename);

        if (!file_exists(storage_path('app/surat/skd'))) {
            mkdir(storage_path('app/surat/skd'), 0755, true);
        }

        $templateProcessor->saveAs($outputPath);

        return $filename;
    }

    private function regenerateFile($pengajuan, $skd)
    {
        $tanggalBerlaku = now()->addDays(90);

        $data = [
            'nomor_surat' => $pengajuan->nomor_surat,
            'tanggal_surat' => now()->format('d-m-Y'),
            'tanggal_berlaku' => $tanggalBerlaku->format('d-m-Y'),
            'hari_ini' => now()->format('d-m-Y'),
            'nama' => $skd->nama,
            'nik' => $skd->nik,
            'tempat_lahir' => $skd->tempat_lahir,
            'tanggal_lahir' => \Carbon\Carbon::parse($skd->tanggal_lahir)->format('d-m-Y'),
            'jenis_kelamin' => $skd->jenis_kelamin,
            'bangsa_agama' => 'Indonesia / ' . $skd->agama,
            'status_perkawinan' => $skd->status_perkawinan,
            'pekerjaan' => $skd->pekerjaan,
            'rt' => $skd->rt,
            'rw' => $skd->rw,
            'dusun' => $skd->dusun,
            'alamat' => $skd->alamat . ' RT ' . $skd->rt . '/RW ' . $skd->rw .
                ($skd->dusun ? ', Dusun ' . $skd->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
            'no_surat_rt' => $skd->no_surat_rt,
            'tanggal_surat_rt' => \Carbon\Carbon::parse($skd->tanggal_surat_rt)->format('d-m-Y'),
            'keperluan_html' => $skd->keperluan,
        ];

        $templatePath = resource_path('files/surat-domisili.docx');

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

        $outputPath = storage_path('app/surat/skd/' . $pengajuan->file_surat_cetak);
        $templateProcessor->saveAs($outputPath);

        $pengajuan->update(['tanggal_cetak' => now()]);
    }

    public function success($file)
    {
        $filePath = storage_path('app/surat/skd/' . $file);
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        return view('admin.surat.skd.success', compact('file'));
    }

    public function download($file)
    {
        $filePath = storage_path('app/surat/skd/' . $file);
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
