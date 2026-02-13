<?php

namespace App\Mail;

use App\Models\Recette;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecetteCreee extends Mailable
{
    use SerializesModels;

    public function __construct(public Recette $recette)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Votre recette a été publiée');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.recette-creee');
    }

    public function attachments(): array
    {
        return [];
    }
}
