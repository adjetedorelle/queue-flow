<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnvoyerOtp extends Notification implements ShouldQueue    
{
    use Queueable;
     public $code_otp;
    /**
     * Create a new notification instance.
     */
    public function __construct($code_otp)
    {
       $this->code_otp = $code_otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('votre code OTP est le :' . $this->code_otp . '.')
                    ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'votre code OTP est le :' . $this->code_otp . '.',
            'date_envoie' => now(),
            'utilisateur_id' => $notifiable->id
        ];
    }
}
