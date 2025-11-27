<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DemoController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        return view('demo.admin.dashboard');
    }

    // Detail Pengajuan
    public function detail()
    {
        return view('demo.admin.detail');
    }

    // Approve & Generate Surat REAL
    public function approve(Request $request)
    {
        try {
            // Data dummy untuk demo
            $data = [
                'nomor_surat' => '001/SKD/XI/2024',
                'tanggal_surat' => now()->translatedFormat('d F Y'),
                'nama' => 'Budi Santoso',
                'nik' => '3201234567890123',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '15 Januari 1985',
                'jenis_kelamin' => 'Laki-laki',
                'bangsa_agama' => 'Indonesia/Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan' => 'Buruh Harian',
                'alamat' => 'Jl. Merdeka No. 123, RT 001/RW 002, Kelurahan Sukamaju, Kecamatan Cikarang Utara',
                'keperluan' => 'Bantuan Pendidikan Anak',
                'keterangan' => 'Untuk mengajukan beasiswa pendidikan anak SD',
            ];

            // Path template (ambil dari resources)
            $templatePath = resource_path('files/surat-keterangan-miskin.docx');

            if (!file_exists($templatePath)) {
                return back()->with('error', 'Template surat tidak ditemukan di resources/files/surat-keterangan-miskin.docx');
            }

            // Load template
            $templateProcessor = new TemplateProcessor($templatePath);

            // Replace semua placeholder
            foreach ($data as $key => $value) {
                $templateProcessor->setValue($key, $value);
            }

            // Generate filename
            $filename = 'SKTM_' . time() . '.docx';
            $outputPath = public_path('downloads/' . $filename);

            // Pastikan folder downloads ada
            if (!file_exists(public_path('downloads'))) {
                mkdir(public_path('downloads'), 0755, true);
            }

            // Save dokumen
            $templateProcessor->saveAs($outputPath);

            // Redirect ke halaman success dengan link download
            return redirect()->route('demo.admin.success', ['file' => $filename])
                ->with('success', 'Surat berhasil dibuat!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Reject (dummy)
    public function reject(Request $request)
    {
        $request->validate([
            'catatan_admin' => 'required|string',
        ]);

        return redirect()->route('demo.admin.dashboard')
            ->with('success', 'Pengajuan berhasil ditolak. Email notifikasi telah dikirim ke user.');
    }

    // Success page dengan download
    public function success($file)
    {
        $filePath = public_path('downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return view('demo.admin.success', compact('file'));
    }

    // Download generated file
    public function download($file)
    {
        $filePath = public_path('downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath);
    }

    // ========== PEJABAT DEMO ==========

    // Dashboard Pejabat
    public function pejabatDashboard()
    {
        return view('demo.pejabat.dashboard');
    }

    // Detail surat untuk TTD
    public function pejabatDetail()
    {
        return view('demo.pejabat.detail');
    }

    // Tandatangani surat REAL
    public function pejabatSign()
    {
        try {
            // Path dokumen yang sudah dibuat admin (untuk demo, kita ambil yang terbaru)
            $downloadsPath = public_path('downloads');
            $files = glob($downloadsPath . '/SKTM_*.docx');

            if (empty($files)) {
                return back()->with('error', 'Tidak ada surat yang perlu ditandatangani. Silakan admin approve pengajuan terlebih dahulu.');
            }

            // Ambil file terbaru
            $latestFile = array_reverse($files)[0];

            // Path tanda tangan (dari resources)
            $signaturePath = resource_path('files/ttd.png');

            if (!file_exists($signaturePath)) {
                return back()->with('error', 'File tanda tangan tidak ditemukan di resources/files/ttd.png');
            }

            // Load dokumen
            $templateProcessor = new TemplateProcessor($latestFile);

            // Insert tanda tangan sebagai gambar
            $templateProcessor->setImageValue('ttd', [
                'path' => $signaturePath,
                'width' => 150,
                'height' => 75,
            ]);

            // Set nama dan tanggal TTD
            $templateProcessor->setValue('nama_pejabat', 'H. Ahmad Sudrajat, S.Sos');
            $templateProcessor->setValue('jabatan_pejabat', 'Kepala Desa Sukamaju');
            $templateProcessor->setValue('tanggal_ttd', now()->translatedFormat('d F Y'));

            // Save kembali
            $templateProcessor->saveAs($latestFile);

            // Redirect ke success
            return redirect()->route('demo.pejabat.signed')
                ->with('success', 'Surat berhasil ditandatangani!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Success page setelah TTD
    public function pejabatSigned()
    {
        // Ambil file terbaru untuk download
        $files = glob(public_path('downloads/SKTM_*.docx'));
        $latestFile = !empty($files) ? basename(array_reverse($files)[0]) : null;

        return view('demo.pejabat.signed', compact('latestFile'));
    }
}
