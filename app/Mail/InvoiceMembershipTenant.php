<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMembershipTenant extends Mailable
{
    use Queueable, SerializesModels;

    private $full_name, $transaction_date, $membershipPlan, $tax, $total, $status;

    /**
     * Create a new message instance.
     */
    public function __construct($datas)
    {
        $this->full_name = $datas['full_name'];
        $this->transaction_date = $datas['transaction_date'];
        $this->membershipPlan = $datas['membership_plan'];
        $this->tax = $datas['tax'];
        $this->total = $datas['total'];
        $this->status = $datas['status'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Membership Tenant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
