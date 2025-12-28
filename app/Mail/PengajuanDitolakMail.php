<?php

namespace App\Mail;

use App\Models\PengajuanSurat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengajuanDitolakMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengajuan;
    public $catatan;

    /**
     * Create a new message instance.
     */
    public function __construct(PengajuanSurat $pengajuan, $catatan)
    {
        $this->pengajuan = $pengajuan;
        $this->catatan = $catatan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan Surat Ditolak - ' . $this->pengajuan->no_pengajuan,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pengajuan-ditolak',
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
