<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\SuratPenghasilan;
use App\Mail\PengajuanDitolakMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class SkpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $query = PengajuanSurat::with(['jenisSurat', 'admin'])
            ->whereHas('jenisSurat', function ($q) {
                $q->where('kode', 'SKP');
            });

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                    ->orWhere('nomor_pengajuan', 'like', "%{$search}%")
                    ->orWhere('email_pemohon', 'like', "%{$search}%")
                    ->orWhere('no_hp_pemohon', 'like', "%{$search}%");
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuanList = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $pendingSkp = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKP');
        })->where('status', 'pending')->count();

        $diprosesSkp = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKP');
        })->where('status', 'diproses')->count();

        $ditolakSkp = PengajuanSurat::whereHas('jenisSurat', function ($q) {
            $q->where('kode', 'SKP');
        })->where('status', 'ditolak')->count();

        return view('admin.surat.skp.index', compact(
            'pengajuanList',
            'pendingSkp',
            'diprosesSkp',
            'ditolakSkp'
        ));
    }

    public function detail($id)
    {
        $pengajuan = PengajuanSurat::with(['jenisSurat', 'admin'])->findOrFail($id);
        $skp = SuratPenghasilan::where('pengajuan_surat_id', $id)->firstOrFail();

        return view('admin.surat.skp.detail', compact('pengajuan', 'skp'));
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
            'penghasilan_perbulan' => 'required|numeric|min:0',
            'nama_anak' => 'nullable|string|max:100',
            'keterangan_tambahan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);
            $skp = SuratPenghasilan::where('pengajuan_surat_id', $id)->firstOrFail();

            // Update data SKP
            $skp->update([
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
                'penghasilan_perbulan' => $request->penghasilan_perbulan,
                'nama_anak' => $request->nama_anak,
                'keterangan_tambahan' => $request->keterangan_tambahan,
            ]);

            // Auto regenerate file jika sudah diproses
            $fileRegenerated = false;
            if ($pengajuan->status === 'diproses' && $pengajuan->file_surat_cetak) {
                $this->regenerateFile($pengajuan, $skp);
                $fileRegenerated = true;
            }

            DB::commit();

            $message = 'Data SKP berhasil diperbarui.';
            if ($fileRegenerated) {
                $message .= ' File surat telah di-generate ulang dengan data terbaru.';
            }

            return redirect()
                ->route('admin.skp.detail', $id)
                ->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal. Periksa kembali data yang diinput.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', 'Data SKP tidak ditemukan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update SKP: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    /**
     * Regenerate file SKP setelah update data
     */
    private function regenerateFile($pengajuan, $skp)
    {
        $data = [
            'nomor_surat' => $pengajuan->nomor_surat,
            'tanggal_surat' => now()->translatedFormat('d F Y'),
            'hari_ini' => now()->translatedFormat('d F Y'),
            'nama' => $skp->nama,
            'nik' => $skp->nik,
            'tempat_lahir' => $skp->tempat_lahir,
            'tanggal_lahir' => \Carbon\Carbon::parse($skp->tanggal_lahir)->translatedFormat('d F Y'),
            'jenis_kelamin' => $skp->jenis_kelamin,
            'bangsa_agama' => 'Indonesia / ' . $skp->agama,
            'status_perkawinan' => $skp->status_perkawinan,
            'pekerjaan' => $skp->pekerjaan,
            'rt' => $skp->rt,
            'rw' => $skp->rw,
            'dusun' => $skp->dusun,
            'alamat' => $skp->alamat . ' RT ' . $skp->rt . '/RW ' . $skp->rw .
                ($skp->dusun ? ', Dusun ' . $skp->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
            'no_surat_rt' => $skp->no_surat_rt,
            'tanggal_surat_rt' => \Carbon\Carbon::parse($skp->tanggal_surat_rt)->translatedFormat('d F Y'),
            'penghasilan_perbulan' => 'Rp ' . number_format($skp->penghasilan_perbulan, 0, ',', '.'),
            'nama_anak' => $skp->nama_anak ?? '-',
            'keterangan_tambahan_html' => $skp->keterangan_tambahan,
        ];

        $templatePath = resource_path('files/surat-penghasilan.docx');

        if (!file_exists($templatePath)) {
            throw new \Exception('Template DOCX tidak ditemukan');
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            if ($key !== 'keterangan_tambahan_html') {
                $templateProcessor->setValue($key, $value);
            }
        }

        if (!empty($data['keterangan_tambahan_html'])) {
            $keteranganInline = trim(
                preg_replace('/\s+/', ' ', strip_tags($data['keterangan_tambahan_html']))
            );
            $templateProcessor->setValue('keterangan_tambahan', $keteranganInline);
        } else {
            $templateProcessor->setValue('keterangan_tambahan', '-');
        }

        // Overwrite file lama
        $outputPath = public_path('downloads/' . $pengajuan->file_surat_cetak);
        $templateProcessor->saveAs($outputPath);

        // Update tanggal cetak
        $pengajuan->update([
            'tanggal_cetak' => now(),
        ]);
    }

    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);
            $skp = SuratPenghasilan::where('pengajuan_surat_id', $id)->firstOrFail();
            $jenisSurat = $pengajuan->jenisSurat;

            $nomorSurat = $this->generateNomorSurat($jenisSurat);

            $data = [
                'nomor_surat' => $nomorSurat,
                'tanggal_surat' => now()->translatedFormat('d F Y'),
                'hari_ini' => now()->translatedFormat('d F Y'),
                'nama' => $skp->nama,
                'nik' => $skp->nik,
                'tempat_lahir' => $skp->tempat_lahir,
                'tanggal_lahir' => \Carbon\Carbon::parse($skp->tanggal_lahir)->translatedFormat('d F Y'),
                'jenis_kelamin' => $skp->jenis_kelamin,
                'bangsa_agama' => 'Indonesia / ' . $skp->agama,
                'status_perkawinan' => $skp->status_perkawinan,
                'rt' => $skp->rt,
                'rw' => $skp->rw,
                'dusun' => $skp->dusun,
                'pekerjaan' => $skp->pekerjaan,
                'alamat' => $skp->alamat . ' RT ' . $skp->rt . '/RW ' . $skp->rw .
                    ($skp->dusun ? ', Dusun ' . $skp->dusun : '') .
                    ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin, Provinsi Sumatera Selatan',
                'no_surat_rt' => $skp->no_surat_rt,
                'tanggal_surat_rt' => \Carbon\Carbon::parse($skp->tanggal_surat_rt)->translatedFormat('d F Y'),
                'penghasilan_perbulan' => 'Rp ' . number_format($skp->penghasilan_perbulan, 0, ',', '.'),
                'nama_anak' => $skp->nama_anak ?? '-',
                'keterangan_tambahan_html' => $skp->keterangan_tambahan,
            ];

            $templatePath = resource_path('files/surat-penghasilan.docx');

            if (!file_exists($templatePath)) {
                throw new \Exception('Template DOCX tidak ditemukan di: ' . $templatePath);
            }

            $templateProcessor = new TemplateProcessor($templatePath);

            foreach ($data as $key => $value) {
                if ($key !== 'keterangan_tambahan_html') {
                    $templateProcessor->setValue($key, $value);
                }
            }

            if (!empty($data['keterangan_tambahan_html'])) {
                $keteranganInline = trim(
                    preg_replace('/\s+/', ' ', strip_tags($data['keterangan_tambahan_html']))
                );
                $templateProcessor->setValue('keterangan_tambahan', $keteranganInline);
            } else {
                $templateProcessor->setValue('keterangan_tambahan', '-');
            }

            $filename = 'SKP_' . $skp->nik . '_' . time() . '.docx';
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

            return redirect()->route('admin.skp.success', $filename)
                ->with('success', 'Surat berhasil disetujui dan dicetak!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error approve SKP: ' . $e->getMessage());
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

            return redirect()->route('admin.skp.index')
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

            if ($pengajuan->file_surat_ttd && Storage::disk('public')->exists('surat_ttd/' . $pengajuan->file_surat_ttd)) {
                Storage::disk('public')->delete('surat_ttd/' . $pengajuan->file_surat_ttd);
            }

            $file = $request->file('file_ttd');
            $filename = 'TTD_' . $pengajuan->nomor_pengajuan . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('surat_ttd', $filename, 'public');

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
        $filePath = public_path('downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return view('admin.surat.skp.success', compact('file'));
    }

    public function download($file)
    {
        $filePath = public_path('downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath);
    }

    /**
     * Download file surat yang sudah ditandatangani
     */
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
