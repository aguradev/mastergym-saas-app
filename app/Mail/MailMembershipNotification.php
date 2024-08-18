<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailMembershipNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $full_name, $status;

    /**
     * Create a new message instance.
     */
    public function __construct($full_name, $status)
    {
        $this->full_name = $full_name;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Membership Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.membership-mail-notification',
            with: [
                "title" => tenant("name"),
                "domain" => tenant()->domains->first()->domain,
                "full_name" => $this->full_name,
                "status" => $this->status
            ]
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
