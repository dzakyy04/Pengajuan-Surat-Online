<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Ditolak</title>
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
            background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 4px solid #991b1b;
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
        .status-announcement {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 2px solid #dc2626;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .status-announcement .status-label {
            font-size: 14px;
            color: #991b1b;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .status-announcement .status-value {
            font-size: 22px;
            font-weight: 700;
            color: #dc2626;
            letter-spacing: 1px;
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
            min-width: 180px;
            font-size: 14px;
        }
        .detail-value {
            color: #2c3e50;
            font-size: 14px;
            flex: 1;
        }
        .rejection-reason {
            background-color: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 6px;
            padding: 25px;
            margin: 25px 0;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #c2410c;
            margin: 0 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #fed7aa;
        }
        .reason-text {
            font-size: 14px;
            color: #78350f;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
            background-color: #fffbeb;
            padding: 15px;
            border-radius: 4px;
            border-left: 3px solid #f59e0b;
        }
        .info-notice {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 18px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-notice strong {
            color: #991b1b;
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }
        .info-notice p {
            margin: 0;
            font-size: 14px;
            color: #7f1d1d;
            line-height: 1.6;
        }
        .action-section {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .action-section p {
            margin: 0 0 15px 0;
            font-size: 14px;
            color: #166534;
            font-weight: 600;
        }
        .action-button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(5, 150, 105, 0.3);
            transition: all 0.3s ease;
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
        .rejection-badge {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
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
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>PEMBERITAHUAN PENGAJUAN DITOLAK</h1>
            <p>Sistem Pengajuan Surat Online Desa Sungai Rebo</p>
        </div>
        
        <div class="content">
            <div class="salutation">
                Kepada Yth.<br>
                <strong>{{ $pengajuan->nama_pemohon }}</strong>
            </div>
            
            <div class="intro-text">
                Dengan hormat,<br><br>
                Melalui email ini, kami sampaikan bahwa permohonan surat yang Bapak/Ibu ajukan telah melalui proses verifikasi oleh petugas yang berwenang. Setelah dilakukan peninjauan secara menyeluruh, dengan sangat menyesal kami informasikan bahwa permohonan tersebut belum dapat disetujui pada tahap ini.
            </div>

            <div class="status-announcement">
                <div class="status-label">STATUS PERMOHONAN</div>
                <div class="status-value">TIDAK DISETUJUI</div>
            </div>
            
            <div class="details-card">
                <div class="detail-item">
                    <div class="detail-label">Nomor Pengajuan</div>
                    <div class="detail-value"><strong>{{ $pengajuan->no_pengajuan }}</strong></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Jenis Permohonan</div>
                    <div class="detail-value">{{ $pengajuan->jenisSurat->nama ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y, H:i') }} WIB</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Diproses</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($pengajuan->tanggal_diproses)->translatedFormat('d F Y, H:i') }} WIB</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status Terkini</div>
                    <div class="detail-value"><span class="rejection-badge">TIDAK DISETUJUI</span></div>
                </div>
            </div>

            <div class="rejection-reason">
                <div class="section-title">Catatan dari Petugas Verifikasi</div>
                <div class="reason-text">{{ $catatan }}</div>
            </div>

            <div class="info-notice">
                <strong>Informasi Penting</strong>
                <p>Bapak/Ibu dapat melakukan pengajuan ulang setelah melengkapi atau memperbaiki dokumen dan persyaratan sesuai dengan catatan yang telah disampaikan di atas. Kami siap membantu proses pengajuan berikutnya.</p>
            </div>

            <div class="action-section">
                <p>Siap untuk mengajukan kembali dengan dokumen yang telah diperbaiki?</p>
                <a href="{{ route('pengajuan') }}" class="action-button">Ajukan Permohonan Baru</a>
            </div>

            <div class="closing-text">
                Kami mohon maaf atas ketidaknyamanan ini dan berharap dapat melayani permohonan Bapak/Ibu dengan lebih baik di kesempatan berikutnya. Terima kasih atas pengertian dan kerjasamanya.
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
                &copy; {{ date('Y') }} Desa Sungai Rebo. Seluruh hak cipta dilindungi undang-undang.
            </p>
        </div>
    </div>
</body>
</html>