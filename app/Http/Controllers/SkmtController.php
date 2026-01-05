<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKematian;
use App\Models\PengajuanSurat;
use App\Mail\PengajuanDitolakMail;
use App\Mail\PengajuanSelesaiMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class SkmtController extends Controller
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
                $q->where('kode', 'SKMT');
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
            $q->where('kode', 'SKMT');
        })->whereBetween('created_at', [$startDate, $endDate]);

        $submittedSkmt = (clone $baseCount)->where('status', 'submitted')->count();
        $verifiedSkmt  = (clone $baseCount)->where('status', 'verified')->count();
        $approvedSkmt  = (clone $baseCount)->where('status', 'approved')->count();
        $notifiedSkmt  = (clone $baseCount)->where('status', 'notified')->count();
        $rejectedSkmt  = (clone $baseCount)->where('status', 'rejected')->count();

        return view('admin.surat.skmt.index', compact(
            'pengajuanList',
            'submittedSkmt',
            'verifiedSkmt',
            'approvedSkmt',
            'notifiedSkmt',
            'rejectedSkmt'
        ));
    }

    public function detail($id)
    {
        $pengajuan = PengajuanSurat::with(['jenisSurat', 'admin'])->findOrFail($id);
        $skmt = SuratKematian::where('pengajuan_surat_id', $id)->firstOrFail();

        return view('admin.surat.skmt.detail', compact('pengajuan', 'skmt'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_almarhum' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'umur' => 'required|integer|min:0',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'dusun' => 'nullable|string|max:50',
            'tanggal_meninggal' => 'required|date',
            'jam_meninggal' => 'required',
            'hari_meninggal' => 'required|string|max:20',
            'tempat_meninggal' => 'required|string|max:100',
            'sebab_meninggal' => 'required|string|max:100',
            'nama_pelapor' => 'required|string|max:100',
            'nik_pelapor' => 'required|string|size:16',
            'jenis_kelamin_pelapor' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir_pelapor' => 'required|string|max:100',
            'tanggal_lahir_pelapor' => 'required|date',
            'agama_pelapor' => 'required|string|max:20',
            'pekerjaan_pelapor' => 'required|string|max:100',
            'alamat_pelapor' => 'required|string',
            'rt_pelapor' => 'required|string|max:5',
            'rw_pelapor' => 'required|string|max:5',
            'hubungan_pelapor' => 'required|string|max:50',
        ]);

        try {
            DB::beginTransaction();

            $pengajuan = PengajuanSurat::findOrFail($id);
            $skmt = SuratKematian::where('pengajuan_surat_id', $id)->firstOrFail();

            $skmt->update([
                'nama_almarhum' => $request->nama_almarhum,
                'jenis_kelamin' => $request->jenis_kelamin,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'dusun' => $request->dusun,
                'tanggal_meninggal' => $request->tanggal_meninggal,
                'jam_meninggal' => $request->jam_meninggal,
                'hari_meninggal' => $request->hari_meninggal,
                'tempat_meninggal' => $request->tempat_meninggal,
                'sebab_meninggal' => $request->sebab_meninggal,
                'nama_pelapor' => $request->nama_pelapor,
                'nik_pelapor' => $request->nik_pelapor,
                'jenis_kelamin_pelapor' => $request->jenis_kelamin_pelapor,
                'tempat_lahir_pelapor' => $request->tempat_lahir_pelapor,
                'tanggal_lahir_pelapor' => $request->tanggal_lahir_pelapor,
                'agama_pelapor' => $request->agama_pelapor,
                'pekerjaan_pelapor' => $request->pekerjaan_pelapor,
                'alamat_pelapor' => $request->alamat_pelapor,
                'rt_pelapor' => $request->rt_pelapor,
                'rw_pelapor' => $request->rw_pelapor,
                'hubungan_pelapor' => $request->hubungan_pelapor,
            ]);

            $fileRegenerated = false;
            if (in_array($pengajuan->status, ['verified', 'approved']) && $pengajuan->file_surat_cetak) {
                $this->regenerateFile($pengajuan, $skmt);
                $fileRegenerated = true;
            }

            DB::commit();

            $message = 'Data Surat Kematian berhasil diperbarui.';
            if ($fileRegenerated) {
                $message .= ' File surat telah di-generate ulang dengan data terbaru.';
            }

            return redirect()
                ->route('admin.skmt.detail', $id)
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update SKMT: ' . $e->getMessage());
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

            $skmt = SuratKematian::where('pengajuan_surat_id', $id)->firstOrFail();
            $jenisSurat = $pengajuan->jenisSurat;

            $nomorSurat = $this->generateNomorSurat($jenisSurat);
            $filename = $this->generateSuratFile($pengajuan, $skmt, $nomorSurat);

            $pengajuan->update([
                'status' => 'verified',
                'nomor_surat' => $nomorSurat,
                'admin_id' => Auth::guard('admin')->id(),
                'tanggal_diproses' => now(),
                'file_surat_cetak' => $filename,
                'tanggal_cetak' => now(),
            ]);

            DB::commit();

            return redirect()->route('admin.skmt.success', $filename)
                ->with('success', 'Surat berhasil disetujui dan dicetak!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error verify SKMT: ' . $e->getMessage());
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

            return redirect()->route('admin.skmt.index')
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

            return back()->with('success', 'Notifikasi berhasil dikirim ke ' . $pengajuan->email_pemohon . '. Status berubah menjadi Notified.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error send notification SKMT: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateSuratFile($pengajuan, $skmt, $nomorSurat)
    {
        $data = [
            'nomor_surat' => $nomorSurat,
            'tanggal_surat' => now()->format('d-m-Y'),
            'nama_almarhum' => $skmt->nama_almarhum,
            'jenis_kelamin' => $skmt->jenis_kelamin,
            'umur' => $skmt->umur,
            'alamat_almarhum' => $skmt->alamat . ' RT ' . $skmt->rt . '/RW ' . $skmt->rw .
                ($skmt->dusun ? ', Dusun ' . $skmt->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin',
            'tanggal_meninggal' => \Carbon\Carbon::parse($skmt->tanggal_meninggal)->format('d-m-Y'),
            'jam_meninggal' => $skmt->jam_meninggal,
            'hari_meninggal' => $skmt->hari_meninggal,
            'tempat_meninggal' => $skmt->tempat_meninggal,
            'sebab_meninggal' => $skmt->sebab_meninggal,
            'nama_pelapor' => $skmt->nama_pelapor,
            'nik_pelapor' => $skmt->nik_pelapor,
            'jenis_kelamin_pelapor' => $skmt->jenis_kelamin_pelapor,
            'tempat_lahir_pelapor' => $skmt->tempat_lahir_pelapor,
            'tanggal_lahir_pelapor' => \Carbon\Carbon::parse($skmt->tanggal_lahir_pelapor)->format('d-m-Y'),
            'agama_pelapor' => $skmt->agama_pelapor,
            'pekerjaan_pelapor' => $skmt->pekerjaan_pelapor,
            'alamat_pelapor' => $skmt->alamat_pelapor . ' RT ' . $skmt->rt_pelapor . '/RW ' . $skmt->rw_pelapor .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin',
            'hubungan_pelapor' => $skmt->hubungan_pelapor,
        ];

        $templatePath = resource_path('files/surat-kematian.docx');

        if (!file_exists($templatePath)) {
            throw new \Exception('Template DOCX tidak ditemukan');
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        $filename = 'SKMT_' . $skmt->nik_pelapor . '_' . time() . '.docx';
        $outputPath = storage_path('app/' . self::PATH_SURAT_CETAK . '/' . $filename);

        // Pastikan folder cetak ada
        if (!file_exists(storage_path('app/' . self::PATH_SURAT_CETAK))) {
            mkdir(storage_path('app/' . self::PATH_SURAT_CETAK), 0755, true);
        }

        $templateProcessor->saveAs($outputPath);

        return $filename;
    }

    private function regenerateFile($pengajuan, $skmt)
    {
        $data = [
            'nomor_surat' => $pengajuan->nomor_surat,
            'tanggal_surat' => now()->format('d-m-Y'),
            'nama_almarhum' => $skmt->nama_almarhum,
            'jenis_kelamin' => $skmt->jenis_kelamin,
            'umur' => $skmt->umur,
            'alamat_almarhum' => $skmt->alamat . ' RT ' . $skmt->rt . '/RW ' . $skmt->rw .
                ($skmt->dusun ? ', Dusun ' . $skmt->dusun : '') .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin',
            'tanggal_meninggal' => \Carbon\Carbon::parse($skmt->tanggal_meninggal)->format('d-m-Y'),
            'jam_meninggal' => $skmt->jam_meninggal,
            'hari_meninggal' => $skmt->hari_meninggal,
            'tempat_meninggal' => $skmt->tempat_meninggal,
            'sebab_meninggal' => $skmt->sebab_meninggal,
            'nama_pelapor' => $skmt->nama_pelapor,
            'nik_pelapor' => $skmt->nik_pelapor,
            'jenis_kelamin_pelapor' => $skmt->jenis_kelamin_pelapor,
            'tempat_lahir_pelapor' => $skmt->tempat_lahir_pelapor,
            'tanggal_lahir_pelapor' => \Carbon\Carbon::parse($skmt->tanggal_lahir_pelapor)->format('d-m-Y'),
            'agama_pelapor' => $skmt->agama_pelapor,
            'pekerjaan_pelapor' => $skmt->pekerjaan_pelapor,
            'alamat_pelapor' => $skmt->alamat_pelapor . ' RT ' . $skmt->rt_pelapor . '/RW ' . $skmt->rw_pelapor .
                ', Desa Sungai Rebo, Kecamatan Banyuasin I, Kabupaten Banyuasin',
            'hubungan_pelapor' => $skmt->hubungan_pelapor,
        ];

        $templatePath = resource_path('files/surat-kematian.docx');

        if (!file_exists($templatePath)) {
            throw new \Exception('Template DOCX tidak ditemukan');
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

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
        return view('admin.surat.skmt.success', compact('file'));
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
