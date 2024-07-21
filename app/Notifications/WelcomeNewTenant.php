<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNewTenant extends Notification implements ShouldQueue
{
    use Queueable;
    private $tenant, $domain;

    /**
     * Create a new notification instance.
     */
    public function __construct($tenant, $domain)
    {
        $this->tenant = $tenant;
        $this->domain = $domain;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Welcome New Tenancy Gym")
            ->greeting("Hello " . $this->tenant->name)
            ->line("We are delighted to welcome you to our property management membership platform.")
            ->action("Visit Your Dashboard", $this->domain);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
