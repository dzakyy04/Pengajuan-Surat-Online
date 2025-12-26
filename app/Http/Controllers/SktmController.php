<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\SuratTidakMampu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SktmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        // Query builder
        $query = PengajuanSurat::with(['jenisSurat', 'admin'])
            ->whereHas('jenisSurat', function ($q) {
                $q->where('kode', 'SKTM');
            });

        // Filter by status jika ada parameter 'status'
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
        $anggotaKeluarga = json_decode($sktm->anggota_keluarga, true) ?? [];

        return view('admin.surat.sktm.detail', compact('pengajuan', 'sktm', 'anggotaKeluarga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // DATA PEMOHON
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'dusun' => 'nullable|string|max:100',
            'alamat' => 'required|string',

            // SURAT RT
            'no_surat_rt' => 'required|string|max:50',
            'tanggal_surat_rt' => 'required|date',

            // KEPERLUAN
            'keperluan' => 'required|string',
        ]);

        try {
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

            return back()->with('success', 'Semua data SKTM berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal update data: ' . $e->getMessage());
        }
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

            $templatePath = resource_path('files/surat-keterangan-miskin-2.docx');

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

            $anggotaKeluarga = json_decode($sktm->anggota_keluarga, true);
            $textRun = new TextRun();
            $fontStyle = ['name' => 'Arial', 'size' => 12];

            if (!empty($anggotaKeluarga) && is_array($anggotaKeluarga)) {
                foreach ($anggotaKeluarga as $index => $anggota) {
                    $no = $index + 1;
                    $nama = $anggota['nama'] ?? '-';
                    $nik = $anggota['nik'] ?? '-';
                    $textRun->addText("{$no}. {$nama} ({$nik})", $fontStyle);
                    $textRun->addTextBreak();
                }
            } else {
                $textRun->addText('-');
            }

            $templateProcessor->setComplexBlock('anggota_keluarga_list', $textRun);

            $filename = 'SKTM_' . $sktm->nik . '_' . time() . '.docx';
            $outputPath = public_path('downloads/' . $filename);

            if (!file_exists(public_path('downloads'))) {
                mkdir(public_path('downloads'), 0755, true);
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
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|min:10',
        ]);

        try {
            $pengajuan = PengajuanSurat::findOrFail($id);

            $pengajuan->update([
                'status' => 'ditolak',
                'admin_id' => Auth::guard('admin')->id(),
                'catatan_admin' => $request->catatan_admin,
                'tanggal_diproses' => now(),
            ]);

            return redirect()->route('admin.sktm.index')
                ->with('success', 'Pengajuan berhasil ditolak. Notifikasi telah dikirim ke pemohon.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function success($file)
    {
        $filePath = public_path('downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return view('admin.surat.sktm.success', compact('file'));
    }

    public function download($file)
    {
        $filePath = public_path('downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath);
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
