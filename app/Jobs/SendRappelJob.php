<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Notifications\RappelTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendRappelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new job instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $user = $this->ticket->client->utilisateur;
            $user->notify(new RappelTicket($this->ticket));

            Log::info('Rappel envoyé avec succès', [
                'ticket_id' => $this->ticket->id,
                'user_id' => $user->id
            ]);
        } catch (\Throwable $th) {
            Log::error('Erreur lors de l\'envoi du rappel', [
                'ticket_id' => $this->ticket->id,
                'error' => $th->getMessage()
            ]);
            throw $th;
        }
    }
}
