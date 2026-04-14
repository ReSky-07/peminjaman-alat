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
    public $pdf;

    public function __construct($peminjaman, $pdf)
    {
        $this->peminjaman = $peminjaman;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Nota Pembayaran Denda')
            ->view('emails.nota')
            ->attachData($this->pdf->output(), 'nota.pdf');
    }
}
