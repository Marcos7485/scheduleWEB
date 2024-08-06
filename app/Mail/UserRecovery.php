<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRecovery extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $recoveryHash;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $recoveryHash)
    {
        $this->user = $user;
        $this->recoveryHash = route('accountrecovery', ['token' => $recoveryHash]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Recovery',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recovery',
            with: ['user' => $this->user, 'recoveryLink' => $this->recoveryHash],
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
