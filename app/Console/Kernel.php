<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Ticket;
use App\Jobs\SendRappelJob;
use Carbon\Carbon;
class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {

            $maintenant = Carbon::now()->format('H:i');

            Ticket::whereNull('heure_rappel')
                ->get()
                ->filter(function ($ticket) use ($maintenant) {

                    $heureRappel = Carbon::parse($ticket->heure_exact)
                        ->subMinutes($ticket->rappel_avant_minutes)
                        ->format('H:i');

                    return $heureRappel === $maintenant;
                })
                ->each(function ($ticket) {

                    SendRappelJob::dispatch($ticket);

                    $ticket->update(['heure_rappel' => Carbon::now()]);
                });

        })->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
















