<?php

namespace App\Mail;

use App\Models\Alms;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlmsWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public Alms $alms;

    public function __construct(Alms $alms)
    {
        $this->alms = $alms;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mathanga Aranya Senasanaya - Daily Alms Registration',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.alms-welcome-mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
