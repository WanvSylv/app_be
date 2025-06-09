<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Abonnement;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('abonnements:verifier')->daily();
        $schedule->call(function () {
            Abonnement::where('date_fin', '<', now())->update(['statut' => 'expiré']);
        })->daily();
        $schedule->command('notification:expiration')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
