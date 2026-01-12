<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Disetujui</title>
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #0d7c4d 0%, #10b981 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 4px solid #065f3e;
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
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 2px solid #10b981;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }

        .status-announcement .status-label {
            font-size: 14px;
            color: #065f3e;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .status-announcement .status-value {
            font-size: 22px;
            font-weight: 700;
            color: #059669;
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

        .attachment-notice {
            background-color: #fffbeb;
            border: 2px solid #fbbf24;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }

        .attachment-notice .icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .attachment-notice strong {
            color: #92400e;
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
        }

        .attachment-notice p {
            margin: 0;
            font-size: 14px;
            color: #78350f;
        }

        .instruction-section {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 25px;
            margin: 25px 0;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e40af;
            margin: 0 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #dbeafe;
        }

        .instruction-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }

        .instruction-list li {
            padding: 10px 0 10px 30px;
            position: relative;
            font-size: 14px;
            color: #1e3a8a;
        }

        .highlight {
            background-color: #fef3c7;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: 600;
            color: #92400e;
        }

        .info-notice {
            background-color: #dbeafe;
            border-left: 4px solid #3b82f6;
            padding: 18px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .info-notice strong {
            color: #1e40af;
            font-size: 14px;
            display: block;
            margin-bottom: 10px;
        }

        .info-notice ul {
            margin: 0;
            padding-left: 20px;
            font-size: 14px;
            color: #1e3a8a;
        }

        .info-notice ul li {
            margin: 6px 0;
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

        .success-badge {
            display: inline-block;
            background: #d1fae5;
            color: #065f3e;
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
            <h1>PEMBERITAHUAN PENGAJUAN SELESAI</h1>
            <p>Sistem Pengajuan Surat Online Desa Sungai Rebo</p>
        </div>

        <div class="content">
            <div class="salutation">
                Kepada Yth.<br>
                <strong>{{ $pengajuan->nama_pemohon }}</strong>
            </div>

            <div class="intro-text">
                Dengan hormat,<br><br>
                Melalui email ini, kami dengan senang hati menyampaikan bahwa permohonan surat yang Bapak/Ibu ajukan
                telah melalui proses verifikasi dan telah mendapatkan persetujuan resmi dari pihak yang berwenang.
            </div>

            <div class="status-announcement">
                <div class="status-label">STATUS PERMOHONAN</div>
                <div class="status-value">DISETUJUI</div>
            </div>

            <div class="details-card">
                <div class="detail-item">
                    <div class="detail-label">Nomor Pengajuan</div>
                    <div class="detail-value"><strong>{{ $pengajuan->nomor_pengajuan }}</strong></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nomor Surat Resmi</div>
                    <div class="detail-value"><strong style="color: #059669;">{{ $pengajuan->nomor_surat }}</strong>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Jenis Permohonan</div>
                    <div class="detail-value">{{ $pengajuan->jenisSurat->nama ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Pengajuan</div>
                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y, H:i') }} WIB</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Persetujuan</div>
                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($pengajuan->tanggal_upload_ttd)->translatedFormat('d F Y, H:i') }} WIB
                    </div>
                </div>
            </div>

            <div class="instruction-section">
                <div class="section-title">Prosedur Pengambilan Surat Fisik</div>
                <ul style="padding-left: 20px; margin: 0;">
                    <li style="margin-bottom: 8px;">Surat dalam bentuk fisik dapat diambil di <strong>Kantor Desa Sungai
                            Rebo</strong>, Kecamatan Banyuasin I, Kabupaten Banyuasin.</li>
                    <li style="margin-bottom: 8px;">Waktu pelayanan pengambilan:
                        <span style="background-color:#fef3c7; padding:2px 6px; border-radius:3px; font-weight:bold;">
                            Senin - Jumat, pukul 08:00 - 16:00 WIB
                        </span>.
                    </li>
                    <li style="margin-bottom: 8px;">Pemohon wajib membawa Kartu Tanda Penduduk (KTP) asli sebagai
                        dokumen identitas.</li>
                    <li style="margin-bottom: 8px;">Tunjukkan email ini atau sebutkan nomor pengajuan
                        <strong>{{ $pengajuan->nomor_pengajuan }}</strong> kepada petugas.</li>
                    <li style="margin-bottom: 8px;">Surat sudah dapat diambil terhitung mulai hari ini.</li>
                </ul>
            </div>

            <div class="info-notice">
                <strong>Informasi Penting</strong>
                <ul>
                    <li>Dokumen PDF yang terlampir telah memiliki tanda tangan elektronik resmi dan sah untuk digunakan
                        dalam keperluan administrasi digital.</li>
                    <li>Untuk keperluan yang memerlukan dokumen fisik bermeterai, silakan melakukan pengambilan langsung
                        di kantor desa.</li>
                </ul>
            </div>

            <div class="closing-text">
                Kami mengucapkan terima kasih atas kepercayaan Bapak/Ibu dalam menggunakan layanan pengajuan surat
                online Desa Sungai Rebo. Semoga surat yang telah dikeluarkan dapat bermanfaat sesuai dengan
                keperluannya.
            </div>

            <div class="signature">
                <p><strong>Hormat kami,</strong></p>
                <p><strong>Pemerintah Desa Sungai Rebo</strong></p>
                <p>Kecamatan Banyuasin I, Kabupaten Banyuasin</p>
            </div>
        </div>

        <div class="footer">
            <p style="margin-bottom: 15px;"><strong>Catatan Penting:</strong></p>
            <p>Email ini dibuat dan dikirimkan secara otomatis oleh sistem. Mohon untuk tidak membalas langsung ke
                alamat email ini.</p>

            <div class="footer-divider"></div>

            <p class="text-center">
                &copy; {{ date('Y') }} Desa Sungai Rebo. Seluruh hak cipta dilindungi undang-undang.
            </p>
        </div>
    </div>
</body>

</html>
