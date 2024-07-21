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
    private $id, $fullName, $payment_type, $address, $total, $tax, $price, $plan_name;

    /**
     * Create a new message instance.
     */
    public function __construct(array $datas)
    {
        extract($datas);

        $this->id = $id;
        $this->fullName = $full_name;
        $this->payment_type = $payment_type;
        $this->address = $address;
        $this->total = $total;
        $this->tax = $tax;
        $this->price = $price;
        $this->plan_name = $plan_name;
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
                "payment_type" => $this->payment_type,
                "address" => $this->address,
                "plan_name" => $this->plan_name,
                "price" => $this->price,
                "total" => $this->total,
                "tax" => $this->tax
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
