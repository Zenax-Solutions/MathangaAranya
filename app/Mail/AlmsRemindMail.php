<?php

namespace App\Mail;

use App\Models\Alms;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlmsRemindMail extends Mailable
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
            subject: 'මාතංග ආරණ්‍ය සේනාසනය - දාන වාරය සිහිකැඳවීම',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.alms-remind-mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
