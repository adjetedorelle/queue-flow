<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Zavudev\Client;

class AnnulationTicket extends Notification implements ShouldQueue
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
            ->subject('Annulation de votre ticket QueueFlow')
            ->greeting('Bonjour ' . $name . ',')
            ->line('Votre ticket #' . $this->ticket->numero . ' a été annulé.')
            ->line('Service : ' . $this->ticket->service->libelle)
            ->line('Date de passage prévue : ' . $datePassage->format('d/m/Y à H:i'))
            ->line('Si vous n\'avez pas demandé cette annulation, veuillez contacter le support.')
            ->action('Prendre un nouveau ticket', url('/'))
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
            'statut' => 'annule',
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

        $message = "Annulation: Votre ticket #{$this->ticket->numero} a été annulé. Service: {$this->ticket->service->libelle}, Date: {$datePassage->format('d/m/Y à H:i')}. Si vous n'avez pas demandé cette annulation, contactez le support.";

        try {
            $result = $client->messages->send([
                'to' => $tel,
                'text' => $message,
            ]);

            Log::info('Annulation WhatsApp envoyé', [
                'ticket_id' => $this->ticket->id,
                'tel' => $tel,
                'result' => $result
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Erreur envoi annulation WhatsApp', [
                'error' => $e->getMessage(),
                'ticket_id' => $this->ticket->id
            ]);
            throw $e;
        }
    }
}
