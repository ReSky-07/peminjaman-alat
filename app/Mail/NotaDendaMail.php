<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;


class NotaDendaMail extends Mailable
{
    public $peminjaman;
    public $invoice; // ✅ tambahkan ini

    public function __construct($peminjaman)
    {
        $this->peminjaman = $peminjaman;

        // 🔥 buat invoice di sini
        $this->invoice = 'INV-' . date('Ymd') . '-' . $peminjaman->id;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.nota', [
            'peminjaman' => $this->peminjaman,
            'invoice' => $this->invoice
        ]);

        return $this->subject('Nota Pembayaran Denda')
            ->view('emails.nota') // email view
            ->with([
                'invoice' => $this->invoice // ✅ kirim ke email
            ])
            ->attachData($pdf->output(), $this->invoice . '.pdf');
    }
}
