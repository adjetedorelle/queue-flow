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
        $datePassage = is_string($this->ticket->heure_exact)
            ? \Carbon\Carbon::parse($this->ticket->heure_exact)
            : $this->ticket->heure_exact;

        return (new MailMessage)
            ->subject('Rappel de votre ticket')
            ->greeting('Bonjour ' . ($this->ticket->client->utilisateur->nom ?? 'Client') . ',')
            ->line('Votre ticket #' . $this->ticket->numero . ' pour le service ' . $this->ticket->service->libelle . ' est prévu le ' . $datePassage->format('d/m/Y à H:i') . '.')
            ->line('Merci de votre ponctualité.')
            ->salutation('Cordialement, l\'équipe QueueFlow');
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

        $datePassage = is_string($this->ticket->heure_exact)
            ? \Carbon\Carbon::parse($this->ticket->heure_exact)
            : $this->ticket->heure_exact;

        $message = "Rappel: Votre ticket #{$this->ticket->numero} pour le service {$this->ticket->service->libelle} est prévu le {$datePassage->format('d/m/Y à H:i')}.";

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
