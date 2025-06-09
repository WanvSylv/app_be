<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Carbon\Carbon;

class AbonnementExpirant extends Notification implements ShouldQueue
{
    use Queueable;

    protected $abonnement;

    public function __construct($abonnement)
    {
        $this->abonnement = $abonnement;
    }

    /**
     * Notification par email
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('⚠️ Votre abonnement expire bientôt')
            ->greeting('Bonjour ' . $notifiable->nom . ',')
            ->line('Votre abonnement à la bibliothèque "' . $this->abonnement->bibliotheque->nom . '" expire le ' . Carbon::parse($this->abonnement->date_fin)->format('d/m/Y') . '.')
            ->line('Pensez à le renouveler pour éviter toute interruption de service.')
            ->action('Renouveler maintenant', url('/abonnements/renouveler/' . $this->abonnement->id))
            ->line('Merci d’utiliser notre service.');
    }

    /**
     * Notification par SMS (via Nexmo ou autre service SMS)
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content("⚠️ Votre abonnement expire bientôt (".Carbon::parse($this->abonnement->date_fin)->format('d/m/Y')."). Renouvelez ici : ". url('/abonnements/renouveler/'.$this->abonnement->id));
    }

    /**
     * Définition des canaux de notification
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo']; // Email + SMS
    }
}
