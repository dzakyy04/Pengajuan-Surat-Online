<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Surat Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            color: #2c3e50;
            max-width: 650px;
            margin: 0 auto;
            padding: 0;
            background-color: #f4f6f9;
        }
        .email-container {
            background-color: #ffffff;
            margin: 30px auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 4px solid #1a2f5a;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 35px;
            background-color: #ffffff;
        }
        .salutation {
            font-size: 15px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .intro-text {
            font-size: 15px;
            color: #34495e;
            margin-bottom: 30px;
            text-align: justify;
        }
        .details-card {
            background-color: #f8f9fa;
            border: 1px solid #e1e8ed;
            border-radius: 6px;
            padding: 25px;
            margin: 25px 0;
        }
        .detail-item {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #5a6c7d;
            min-width: 160px;
            font-size: 14px;
        }
        .detail-value {
            color: #2c3e50;
            font-size: 14px;
            flex: 1;
        }
        .highlight-box {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 18px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .highlight-box strong {
            color: #f57c00;
            font-size: 14px;
        }
        .highlight-box p {
            margin: 8px 0 0 0;
            font-size: 14px;
            color: #5d4037;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin: 30px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #e1e8ed;
        }
        .process-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }
        .process-list li {
            padding: 10px 0 10px 30px;
            position: relative;
            font-size: 14px;
            color: #34495e;
        }
        .process-list li:before {
            content: "▸";
            position: absolute;
            left: 10px;
            color: #2a5298;
            font-weight: bold;
        }
        .closing-text {
            margin-top: 30px;
            font-size: 14px;
            color: #34495e;
            line-height: 1.6;
        }
        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }
        .signature p {
            margin: 5px 0;
            font-size: 14px;
            color: #5a6c7d;
        }
        .signature strong {
            color: #2c3e50;
        }
        .footer {
            background-color: #2c3e50;
            color: #bdc3c7;
            padding: 25px 35px;
            font-size: 12px;
            line-height: 1.6;
        }
        .footer p {
            margin: 8px 0;
        }
        .footer-divider {
            border-top: 1px solid #4a5f7f;
            margin: 15px 0;
        }
        .text-center {
            text-align: center;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 25px 20px;
            }
            .detail-item {
                flex-direction: column;
            }
            .detail-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>PENGAJUAN SURAT BERHASIL</h1>
            <p>Sistem Pengajuan Surat Online Desa Sungai Rebo</p>
        </div>
        
        <div class="content">
            <div class="salutation">
                Kepada Yth.<br>
                <strong>{{ $namaPemohon }}</strong>
            </div>
            
            <div class="intro-text">
                Dengan hormat,<br><br>
                Melalui email ini, kami sampaikan bahwa permohonan surat yang Bapak/Ibu ajukan telah diterima dengan baik oleh sistem kami dan saat ini sedang dalam tahap pemrosesan. Kami mengucapkan terima kasih atas kepercayaan Anda menggunakan layanan pengajuan surat online Desa Sungai Rebo.
            </div>
            
            <div class="details-card">
                <div class="detail-item">
                    <div class="detail-label">Nomor Pengajuan</div>
                    <div class="detail-value"><strong style="color: #2a5298; font-size: 15px;">{{ $nomorPengajuan }}</strong></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Jenis Permohonan</div>
                    <div class="detail-value">{{ $jenisSurat }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">{{ $tanggalPengajuan }}</div>
                </div>
            </div>

            <div class="highlight-box">
                <strong>PERHATIAN</strong>
                <p>Harap menyimpan nomor pengajuan di atas untuk keperluan pelacakan status permohonan dan korespondensi selanjutnya dengan kantor kami.</p>
            </div>

            <div class="section-title">Tahapan Pemrosesan</div>
            <ul class="process-list">
                <li>Permohonan Anda akan diverifikasi oleh petugas yang berwenang sesuai dengan prosedur yang berlaku.</li>
                <li>Pembaruan status permohonan akan disampaikan kepada Anda melalui email secara berkala.</li>
                <li>Apabila diperlukan informasi atau dokumen tambahan, petugas kami akan menghubungi Anda melalui kontak yang telah terdaftar.</li>
            </ul>

            <div class="closing-text">
                Apabila terdapat pertanyaan atau memerlukan bantuan lebih lanjut, Bapak/Ibu dapat menghubungi kami melalui saluran komunikasi resmi yang tersedia di portal layanan kami.
            </div>

            <div class="signature">
                <p><strong>Hormat kami,</strong></p>
                <p><strong>Pemerintah Desa Sungai Rebo</strong></p>
                <p>Kecamatan Banyuasin I, Kabupaten Banyuasin</p>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin-bottom: 15px;"><strong>Catatan Penting:</strong></p>
            <p>Email ini dibuat dan dikirimkan secara otomatis oleh sistem. Mohon untuk tidak membalas langsung ke alamat email ini.</p>
            
            <div class="footer-divider"></div>
            
            <p class="text-center">
                &copy; {{ date('Y') }} Sistem Pengajuan Surat Desa. Seluruh hak cipta dilindungi undang-undang.
            </p>
        </div>
    </div>
</body>
</html>