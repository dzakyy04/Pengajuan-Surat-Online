<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;


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



    public function approve(Request $request)
    {
        try {
            $data = [
                'nomor_surat' => '001/SKD/XI/2024',
                'tanggal_surat' => now()->translatedFormat('d F Y'),
                'nama' => 'Budi Santoso',
                'nik' => '3201234567890123',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '15 Januari 1985',
                'jenis_kelamin' => 'Laki-laki',
                'bangsa_agama' => 'Indonesia / Islam',
                'status_perkawinan' => 'Kawin',
                'pekerjaan' => 'Buruh Harian',
                'alamat' => 'Jl. Merdeka No. 123 RT 001/RW 002, Kelurahan Sukamaju Banget, Kecamatan Cikarang Utara, Kabupaten Bekasi, Provinsi Jawa Barat',
                'keperluan_html' => '
                <p>Berdasarkan surat pengantar Ketua RT 001 Dusun I No.016/SR/2024 Desa Sungai Rebo. Tertanggal 29 November 2024 benar bahwa nama tersebut adalah penduduk Desa Sungai Rebo. Kecamatan Banyuasin I Kabupaten Banyuasin.</p>
                <p>Sebagaimana Alamat diatas, Memang benar termasuk keluarga tidak mampu (Miskin).</p>
                <p>Surat Keterangan ini diberikan : Untuk Pelengkap Administrasi Membuat KIS</p>',
            ];

            $templatePath = resource_path('files/surat-keterangan-miskin-2.docx');
            $templateProcessor = new TemplateProcessor($templatePath);

            // ========================================
            // 1️⃣ SET SEMUA VALUE KECUALI KEPERLUAN
            // ========================================
            foreach ($data as $key => $value) {
                if ($key !== 'keperluan_html') {
                    $templateProcessor->setValue($key, $value);
                }
            }

            // ========================================
            // 2️⃣ SET KEPERLUAN DENGAN FORMAT PARAGRAF
            // ========================================
            if (!empty($data['keperluan_html'])) {
                $paragraphs = $this->convertHtmlToParagraphs($data['keperluan_html']);
                $templateProcessor->setComplexBlock('keperluan', $paragraphs);
            }

            // ========================================
            // 3️⃣ CLONE ROW UNTUK NAMA & NIK (OPSIONAL)
            // Kalau di template ada ${nama} dan ${nik} di bawah keperluan
            // ========================================
            // $templateProcessor->setValue('nama', $data['nama']);
            // $templateProcessor->setValue('nik', $data['nik']);

            // Save file
            $filename = 'SKTM_' . time() . '.docx';
            $outputPath = public_path('downloads/' . $filename);

            if (!file_exists(public_path('downloads'))) {
                mkdir(public_path('downloads'), 0755, true);
            }

            $templateProcessor->saveAs($outputPath);
            return response()->download($outputPath);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * 🔥 FIXED: Font + Spacing + Line Breaks
     */
    private function convertHtmlToParagraphs(string $html)
    {
        $textRun = new \PhpOffice\PhpWord\Element\TextRun();

        // Parse HTML ke array paragraf
        $html = str_replace(['<br>', '<br/>', '<br />'], '</p><p>', $html);
        preg_match_all('/<p[^>]*>(.*?)<\/p>/s', $html, $matches);

        // 🔥 FONT STYLE (SESUAIKAN DENGAN TEMPLATE WORD ANDA)
        $fontStyle = [
            'name' => 'Arial', // Ganti sesuai template
            'size' => 12,                 // Ganti sesuai template
        ];

        $counter = 1;
        $totalParagraphs = count($matches[1]);

        foreach ($matches[1] as $index => $paragraph) {
            $text = strip_tags($paragraph);
            $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
            $text = trim($text);

            if (empty($text))
                continue;

            // Handle <li> jika ada
            if (strpos($paragraph, '<li>') !== false) {
                preg_match_all('/<li>(.*?)<\/li>/s', $paragraph, $items);
                foreach ($items[1] as $item) {
                    $itemText = strip_tags($item);
                    $itemText = html_entity_decode($itemText, ENT_QUOTES, 'UTF-8');
                    $textRun->addText($counter . '. ' . trim($itemText), $fontStyle);
                    $textRun->addTextBreak(); // 1 baris baru
                    $counter++;
                }
            } else {
                // 🔥 TAMBAHKAN TEXT DENGAN FONT STYLE
                $textRun->addText($text, $fontStyle);

                // 🔥 HANYA TAMBAH 1 BARIS JIKA BUKAN PARAGRAF TERAKHIR
                if ($index < $totalParagraphs - 1) {
                    $textRun->addTextBreak(1); // Cukup 1x saja
                }
            }
        }

        return $textRun;
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
