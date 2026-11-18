<?php

namespace App\Mail;

use App\Models\GrupoMusical;
use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservaConfirmada extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Reserva $reserva,
        public ?GrupoMusical $grupo,
        public int $horas,
        public float $total,
        public string $metodoPago
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de reserva - MusikEventos',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reserva-confirmada',
        );
    }
}
