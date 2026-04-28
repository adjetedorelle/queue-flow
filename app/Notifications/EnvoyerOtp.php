<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Zavudev\Client;

class EnvoyerOtp extends Notification implements ShouldQueue
{
    use Queueable;
    public $code_otp;
    public $channel;

    /**
     * Create a new notification instance.
     */
    public function __construct($code_otp, $channel = 'mail')
    {
        $this->code_otp = $code_otp;
        $this->channel = $channel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Pour WhatsApp, on utilise un envoi direct dans le contrôleur
        // car Laravel Notifications ne supporte pas nativement les canaux personnalisés
        if ($this->channel === 'mail' && $notifiable->email) {
            return ['mail'];
        }
        
        return [];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Votre code de vérification')
                    ->line('votre code OTP est le :' . $this->code_otp . '.')
                    ->line('Ce code expire dans 5 minutes.')
                    ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Send the notification via WhatsApp using Zavu.dev
     */
    public function toZavuWhatsApp(object $notifiable): array
    {
        Log::info('Tentative envoi WhatsApp OTP', [
            'user_id' => $notifiable->id,
            'tel' => $notifiable->tel,
            'code_otp' => $this->code_otp
        ]);

        try {
            $apiKey = config('zavu.api_key');
            $isTestMode = str_starts_with($apiKey, 'zv_test_');
            
            Log::info('Configuration Zavu.dev', [
                'is_test_mode' => $isTestMode,
                'api_key_prefix' => substr($apiKey, 0, 20) . '...'
            ]);

            $client = new Client(apiKey: $apiKey);
            
            $message = $client->messages->send(
                to: $notifiable->tel,
                text: "Votre code de vérification QueueFlow est : {$this->code_otp}. Ce code expire dans 5 minutes.",
            );
            
            Log::info('Message WhatsApp envoyé avec succès', [
                'message_id' => $message->id ?? null,
                'user_id' => $notifiable->id
            ]);
            
            return [
                'status' => 'sent',
                'message_id' => $message->id ?? null,
            ];
        } catch (\Exception $e) {
            Log::error('Erreur envoi WhatsApp OTP', [
                'error' => $e->getMessage(),
                'user_id' => $notifiable->id,
                'tel' => $notifiable->tel
            ]);
            return [
                'status' => 'failed',
                'error' => $e->getMessage(),
            ];
        }
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
            'utilisateur_id' => $notifiable->id,
            'channel' => $this->channel,
        ];
    }
}
