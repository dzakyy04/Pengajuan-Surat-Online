<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Ditolak</title>
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
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
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
            background: #fef2f2;
            border-left: 4px solid #dc2626;
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
        .catatan-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .catatan-box h3 {
            margin-top: 0;
            color: #c2410c;
            font-size: 16px;
        }
        .catatan-text {
            color: #78350f;
            white-space: pre-wrap;
            word-wrap: break-word;
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
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #059669;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: bold;
        }
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin: 15px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>❌ Pengajuan Ditolak</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Sistem Administrasi Desa Sungai Rebo</p>
    </div>

    <div class="content">
        <p>Yth. <strong>{{ $pengajuan->nama_pemohon }}</strong>,</p>
        
        <p>Mohon maaf, pengajuan surat Anda telah <strong style="color: #dc2626;">DITOLAK</strong> oleh admin desa.</p>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Nomor Pengajuan:</span>
                <span class="info-value"><strong>{{ $pengajuan->no_pengajuan }}</strong></span>
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
                <span class="info-label">Tanggal Diproses:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($pengajuan->tanggal_diproses)->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value"><strong style="color: #dc2626;">DITOLAK</strong></span>
            </div>
        </div>

        <div class="catatan-box">
            <h3>📝 Alasan Penolakan:</h3>
            <p class="catatan-text">{{ $catatan }}</p>
        </div>

        <div class="alert">
            <strong>ℹ️ Informasi:</strong><br>
            Anda dapat melakukan pengajuan ulang dengan melengkapi atau memperbaiki dokumen sesuai catatan di atas.
        </div>

        <p style="margin-top: 25px;">Jika ada pertanyaan lebih lanjut, silakan hubungi kantor desa atau balas email ini.</p>

        <p style="margin-top: 25px;">
            Terima kasih atas pengertiannya.
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