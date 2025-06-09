<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Abonnement;
use App\Notifications\AbonnementExpirant;
use Carbon\Carbon;

class EnvoyerNotificationExpiration extends Command
{
    protected $signature = 'notification:expiration';
    protected $description = 'Envoyer une notification aux abonnés dont l’abonnement expire bientôt';

    public function handle()
    {
        $date_limite = Carbon::now()->addDays(7); // Abonnements expirant dans 7 jours

        $abonnements = Abonnement::where('date_fin', $date_limite)->get();

        foreach ($abonnements as $abonnement) {
            $abonnement->abonne->notify(new AbonnementExpirant($abonnement));
        }

        $this->info('Notifications envoyées avec succès.');
    }
}
