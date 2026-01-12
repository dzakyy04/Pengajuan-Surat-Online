<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\PengajuanSurat;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class PengajuanSelesaiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengajuan;

    /**
     * Create a new message instance.
     */
    public function __construct(PengajuanSurat $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan Surat Disetujui - ' . $this->pengajuan->nomor_pengajuan,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pengajuan-selesai',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // $attachments = [];

        // if ($this->pengajuan->file_surat_ttd) {
        //     // Path yang benar untuk file TTD
        //     $path = storage_path('app/surat/ttd/' . $this->pengajuan->file_surat_ttd);

        //     if (file_exists($path)) {
        //         $attachments[] = Attachment::fromPath($path)
        //             ->as('Surat_' . $this->pengajuan->nomor_surat . '.' . pathinfo($path, PATHINFO_EXTENSION))
        //             ->withMime(
        //                 mime_content_type($path) ?: 'application/octet-stream'
        //             );
        //     }
        // }

        // return $attachments;
        return [];
    }
}
