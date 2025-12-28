<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pengajuan Surat</title>
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
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #4CAF50;
            border-radius: 3px;
        }
        .info-row {
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✓ Pengajuan Surat Berhasil</h1>
    </div>
    
    <div class="content">
        <p>Yth. <strong>{{ $namaPemohon }}</strong>,</p>
        
        <p>Terima kasih telah mengajukan permohonan surat melalui sistem kami. Pengajuan Anda telah berhasil kami terima dan sedang dalam proses verifikasi.</p>
        
        <div class="info-box">
            <div class="info-row">
                <span class="label">Nomor Pengajuan:</span><br>
                <span class="value" style="font-size: 18px; color: #4CAF50;"><strong>{{ $nomorPengajuan }}</strong></span>
            </div>
            <div class="info-row">
                <span class="label">Jenis Surat:</span><br>
                <span class="value">{{ $jenisSurat }}</span>
            </div>
            <div class="info-row">
                <span class="label">Tanggal Pengajuan:</span><br>
                <span class="value">{{ $tanggalPengajuan }}</span>
            </div>
        </div>

        <div class="alert">
            <strong>⚠️ Penting!</strong><br>
            Simpan nomor pengajuan Anda untuk melakukan pengecekan status atau keperluan lainnya.
        </div>

        <p><strong>Langkah Selanjutnya:</strong></p>
        <ul>
            <li>Pengajuan Anda akan diverifikasi oleh petugas kami</li>
            <li>Anda akan menerima notifikasi email jika ada update status pengajuan</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis, mohon untuk tidak membalas email ini.</p>
        <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui kontak yang tersedia di website.</p>
        <p>&copy; {{ date('Y') }} Sistem Pengajuan Surat Desa</p>
    </div>
</body>
</html>