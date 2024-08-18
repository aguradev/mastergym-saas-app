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

    private $invoice_id, $full_name, $transaction_date, $membership_plan, $tax, $total, $status;

    /**
     * Create a new message instance.
     */
    public function __construct($datas)
    {
        $this->invoice_id = $datas['invoice_id'];
        $this->full_name = $datas['full_name'];
        $this->transaction_date = $datas['transaction_date'];
        $this->membership_plan = $datas['membership_plan'];
        $this->tax = $datas['tax'];
        $this->total = $datas['total'];
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
            view: 'mail.invoice-membership-subscription',
            with: [
                "invoice_id" => $this->invoice_id,
                "title" => tenant("name"),
                "domain" => tenant()->domains->first()->domain,
                "full_name" => $this->full_name,
                "transaction_date" => $this->transaction_date,
                "membership_plan" => $this->membership_plan,
                "tax" => $this->tax,
                "total" => $this->total
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
