<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderTransactionMail extends Mailable
{
    use Queueable, SerializesModels;
    private $fullName, $planName, $dueDate, $paymentUrl;

    public function __construct(array $data)
    {
        $this->fullName = $data["full_name"];
        $this->planName = $data["plan"];
        $this->dueDate = $data["expired_date"];
        $this->paymentUrl = $data["payment_url"];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'MasterGYM - Reminder Transaction',
            from: env('MAIL_FROM_ADDRESS'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.reminder-paid',
            with: [
                "full_name" => $this->fullName,
                "payment_url" => $this->paymentUrl,
                "due_date" => $this->dueDate,
                "plan_name" => $this->planName
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
