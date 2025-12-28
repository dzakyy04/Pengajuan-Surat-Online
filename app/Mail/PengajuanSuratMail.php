<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengajuanSuratMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomorPengajuan;
    public $namaPemohon;
    public $jenisSurat;
    public $tanggalPengajuan;

    /**
     * Create a new message instance.
     */
    public function __construct($nomorPengajuan, $namaPemohon, $jenisSurat)
    {
        $this->nomorPengajuan = $nomorPengajuan;
        $this->namaPemohon = $namaPemohon;
        $this->jenisSurat = $jenisSurat;
        $this->tanggalPengajuan = now()->format('d F Y H:i');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Pengajuan Surat - ' . $this->nomorPengajuan,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pengajuan-surat',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
