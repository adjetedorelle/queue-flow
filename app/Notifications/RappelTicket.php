<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Zavudev\Client;

class RappelTicket extends Notification implements ShouldQueue
{
    use Queueable;

    public $ticket;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
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
        $name = $notifiable->nom ?? $notifiable->name ?? 'Client';
        $datePassage = is_string($this->ticket->jour_passage) 
            ? \Carbon\Carbon::parse($this->ticket->jour_passage) 
            : $this->ticket->jour_passage;
        
        return (new MailMessage)
                    ->subject('Rappel de votre ticket QueueFlow')
                    ->greeting('Bonjour ' . $name . ',')
                    ->line('Ceci est un rappel pour votre ticket.')
                    ->line('Numéro de ticket : ' . $this->ticket->numero)
                    ->line('Service : ' . $this->ticket->service->libelle)
                    ->line('Date de passage : ' . $datePassage->format('d/m/Y'))
                    ->action('Voir votre ticket', url('/'))
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
            'ticket_id' => $this->ticket->id,
            'numero' => $this->ticket->numero,
            'service' => $this->ticket->service->libelle,
            'date_passage' => $this->ticket->jour_passage,
        ];
    }

    /**
     * Send notification via WhatsApp using Zavu.dev
     */
    public function toZavuWhatsApp(object $notifiable)
    {
        $apiKey = config('zavu.api_key');
        $client = new Client($apiKey);

        $tel = $notifiable->tel;

        $datePassage = is_string($this->ticket->jour_passage) 
            ? \Carbon\Carbon::parse($this->ticket->jour_passage) 
            : $this->ticket->jour_passage;
        
        $message = "Rappel: Votre ticket #{$this->ticket->numero} pour le service {$this->ticket->service->libelle} est prévu le {$datePassage->format('d/m/Y')}.";

        try {
            $result = $client->messages->send([
                'to' => $tel,
                'text' => $message,
            ]);

            Log::info('Rappel WhatsApp envoyé', [
                'ticket_id' => $this->ticket->id,
                'tel' => $tel,
                'result' => $result
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Erreur envoi rappel WhatsApp', [
                'error' => $e->getMessage(),
                'ticket_id' => $this->ticket->id
            ]);
            throw $e;
        }
    }
}
