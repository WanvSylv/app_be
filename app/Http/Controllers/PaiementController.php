<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PaiementController extends Controller
{
  
public function checkout($abonnement_id)
{
    $abonnement = Abonnement::with('abonne')->findOrFail($abonnement_id);
    $abonne = $abonnement->abonne;

    $montant = $abonnement->montant ?? 1000;
    $description = "Paiement pour l'abonnement à la bibliothèque";

    return view('paiement.fedapay_checkout', [
        'abonnement_id' => $abonnement->id,
        'montant' => $montant,
        'description' => $description,
        'client' => [
            'prenom' => $abonne->prenom ?? 'Prénom',
            'nom' => $abonne->nom ?? 'Nom',
            'email' => $abonne->email ?? 'inconnu@email.com',
            'contact' => $abonne->contact ?? 'Non renseigné',
        ]
    ]);
}

    /**
     * Enregistre le paiement après succès.
     */
    public function success(Request $request)
    {
        $abonnement = Abonnement::findOrFail($request->abonnement_id);

        Paiement::create([
            'abonnement_id' => $abonnement->id,
            'date_paiement' => now(),
            'montant' => 2000, // adapter si nécessaire
            'numero_momo' => 'Inconnu',
            'statut' => 'réussi',
        ]);

        return redirect()->route('abonnements.index')->with('success', 'Paiement effectué avec succès.');
    }

    /**
     * Traitement en cas d’annulation.
     */
   public function cancel(Request $request)
{
    Log::info('Paiement annulé par l’utilisateur.', [
        'abonnement_id' => $request->abonnement_id ?? null,
        'date' => now()->toDateTimeString(),
        'ip' => $request->ip(),
        'user_agent' => $request->userAgent()
    ]);

    return redirect()->route('abonnements.index')->with('error', 'Paiement annulé.');
}
    
}
