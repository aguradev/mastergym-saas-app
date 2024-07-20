<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoicePaidMail extends Mailable
{
    use Queueable, SerializesModels;
    private $fullName, $payment_type, $address, $total, $tax;

    /**
     * Create a new message instance.
     */
    public function __construct($datas)
    {
        [$full_name, $payment_type, $address, $total, $tax] = $datas;
        $this->fullName = $full_name;
        $this->payment_type = $payment_type;
        $this->address = $address;
        $this->total = $total;
        $this->tax = $tax;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Master Gym - Purchase Plan Order',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.invoice-paid',
            with: [
                "full_name" => $this->fullName,
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
