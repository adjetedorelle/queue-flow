<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Zavudev\Client;

class RebalancementTicket extends Notification implements ShouldQueue
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
                    ->subject('Reclassification de votre ticket QueueFlow')
                    ->greeting('Bonjour ' . $name . ',')
                    ->line('Votre ticket VIP a été reclassé en ticket standard.')
                    ->line('Numéro de ticket : ' . $this->ticket->numero)
                    ->line('Service : ' . $this->ticket->service->libelle)
                    ->line('Date de passage : ' . $datePassage->format('d/m/Y'))
                    ->line('Motif original : ' . ($this->ticket->motif ?? 'N/A'))
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
            'type' => 'standard',
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
        
        $message = "Reclassification: Votre ticket VIP #{$this->ticket->numero} a été reclassé en ticket standard. Service: {$this->ticket->service->libelle}, Date: {$datePassage->format('d/m/Y')}.";

        try {
            $result = $client->messages->send([
                'to' => $tel,
                'text' => $message,
            ]);

            Log::info('Rebalancement WhatsApp envoyé', [
                'ticket_id' => $this->ticket->id,
                'tel' => $tel,
                'result' => $result
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Erreur envoi rebalancement WhatsApp', [
                'error' => $e->getMessage(),
                'ticket_id' => $this->ticket->id
            ]);
            throw $e;
        }
    }
}
