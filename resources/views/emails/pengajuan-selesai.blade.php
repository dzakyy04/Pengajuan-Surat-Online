<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            background: #ffffff;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .info-box {
            background: #f0fdf4;
            border-left: 4px solid #059669;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-row {
            margin: 10px 0;
            display: flex;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 8px;
        }
        .info-label {
            font-weight: bold;
            color: #6b7280;
            min-width: 180px;
        }
        .info-value {
            color: #111827;
        }
        .success-badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .instruction-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .instruction-box h3 {
            margin-top: 0;
            color: #1e40af;
            font-size: 16px;
        }
        .instruction-list {
            color: #1e3a8a;
            margin: 10px 0;
            padding-left: 20px;
        }
        .instruction-list li {
            margin: 8px 0;
        }
        .attachment-box {
            background: #fef3c7;
            border: 2px dashed #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            text-align: center;
        }
        .attachment-box strong {
            color: #92400e;
            font-size: 16px;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            border: 1px solid #e5e7eb;
            border-top: none;
            font-size: 12px;
            color: #6b7280;
        }
        .alert-info {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
            padding: 12px;
            border-radius: 6px;
            margin: 15px 0;
            font-size: 14px;
        }
        .highlight {
            background: #fef3c7;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✅ Pengajuan Disetujui</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Sistem Administrasi Desa Sungai Rebo</p>
    </div>

    <div class="content">
        <p>Yth. <strong>{{ $pengajuan->nama_pemohon }}</strong>,</p>
        
        <p>Selamat! Pengajuan surat Anda telah <strong style="color: #059669;">DISETUJUI</strong> dan surat sudah ditandatangani.</p>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Nomor Pengajuan:</span>
                <span class="info-value"><strong>{{ $pengajuan->nomor_pengajuan }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Surat:</span>
                <span class="info-value"><strong style="color: #059669;">{{ $pengajuan->nomor_surat }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Jenis Surat:</span>
                <span class="info-value">{{ $pengajuan->jenisSurat->nama ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Pengajuan:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Disetujui:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($pengajuan->tanggal_upload_ttd)->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value"><span class="success-badge">DISETUJUI</span></span>
            </div>
        </div>

        <div class="attachment-box">
            <strong>📎 File Surat Terlampir</strong>
            <p style="margin: 10px 0 0 0; color: #92400e;">
                Surat yang telah ditandatangani terlampir dalam email ini dalam format PDF.
            </p>
        </div>

        <div class="instruction-box">
            <h3>📋 Cara Pengambilan Surat Fisik:</h3>
            <ul class="instruction-list">
                <li>Surat fisik dapat diambil di <strong>Kantor Desa Sungai Rebo</strong></li>
                <li>Jam pelayanan: <span class="highlight">Senin - Jumat, 08:00 - 15:00 WIB</span></li>
                <li>Bawa KTP asli sebagai identitas</li>
                <li>Tunjukkan email ini atau nomor pengajuan: <strong>{{ $pengajuan->nomor_pengajuan }}</strong></li>
                <li>Surat dapat diambil mulai <strong>hari ini</strong></li>
            </ul>
        </div>

        <div class="alert-info">
            <strong>ℹ️ Informasi Penting:</strong><br>
            • File PDF yang terlampir sudah memiliki tanda tangan resmi dan dapat digunakan untuk keperluan digital<br>
            • Untuk keperluan yang membutuhkan surat fisik, silakan ambil di kantor desa<br>
            • Jika dalam 30 hari surat fisik tidak diambil, silakan hubungi kantor desa
        </div>

        <p style="margin-top: 25px;">Jika ada pertanyaan, silakan hubungi:</p>
        <ul style="color: #6b7280; margin-top: 10px;">
            <li>Kantor Desa Sungai Rebo</li>
            <li>Telepon: (0711) XXX-XXXX</li>
            <li>Email: desasungairebo@example.com</li>
        </ul>

        <p style="margin-top: 25px;">
            Terima kasih atas kepercayaan Anda menggunakan layanan kami.
        </p>

        <p style="margin-top: 30px; color: #6b7280;">
            Hormat kami,<br>
            <strong>Admin Desa Sungai Rebo</strong><br>
            Kecamatan Banyuasin I, Kabupaten Banyuasin
        </p>
    </div>

    <div class="footer">
        <p style="margin: 0;">
            Email ini dikirim secara otomatis oleh sistem. Mohon tidak membalas langsung ke email ini.
        </p>
        <p style="margin: 10px 0 0 0;">
            © {{ date('Y') }} Desa Sungai Rebo. All rights reserved.
        </p>
    </div>
</body>
</html>