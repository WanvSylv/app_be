<?php

namespace App\Http\Controllers;

use App\Models\Pret;
use App\Models\Livre;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PretController extends Controller
{
    public function index()
    {
        $prets = Pret::with('abonnement.abonne', 'livres')->latest()->get();
        return view('prets.index', compact('prets'));
    }

    public function create()
    {
        $abonnements = Abonnement::with('abonne')->get(); // Tous les abonnés actifs
        $livres = Livre::all();
        return view('prets.create', compact('abonnements', 'livres'));
    }

        public function store(Request $request)
        {
            $request->validate([
                'abonnement_id' => 'required|exists:abonnements,id',
                'livre_id' => 'required|array|min:1',
                'livre_id.*' => 'exists:livres,id',
                'date_pret' => 'required|date',
                'date_retour' => 'required|date|after_or_equal:date_pret',
            ]);

            $pret = Pret::create([
                'abonnement_id' => $request->abonnement_id,
                'date_pret' => $request->date_pret,
                'date_retour' => $request->date_retour,
                'statut' => 'en cours',
            ]);

            $pret->livres()->attach($request->livre_id); // Ajoute tous les livres liés

            return redirect()->route('prets.index')->with('success', 'Prêt enregistré avec succès.');
        }


    public function edit(Pret $pret)
    {
        $abonnements = Abonnement::with('abonne')->get();
        $livres = Livre::all();
        return view('prets.edit', compact('pret', 'abonnements', 'livres'));
    }

    public function update(Request $request, Pret $pret)
    {
        $request->validate([
            'date_retour_reelle' => 'nullable|date',
            'etat_retour' => 'nullable|in:bon,abîmé,perdu',
        ]);

        $pret->date_retour_reelle = $request->date_retour_reelle;
        $pret->etat_retour = $request->etat_retour;

        // Calcul automatique de la pénalité
        $penalite = 0;

        if ($request->date_retour_reelle && $pret->date_retour) {
            $retard = Carbon::parse($pret->date_retour)->diffInDays($request->date_retour_reelle, false);
            if ($retard < 0) {
                $penalite += abs($retard) * 500; // 500 FCFA par jour de retard
                $pret->statut = 'en retard';
            } else {
                $pret->statut = 'retourné';
            }
        }

        // Pénalité supplémentaire selon l'état du livre
        if ($request->etat_retour === 'abîmé') {
            $penalite += 1000;
        } elseif ($request->etat_retour === 'perdu') {
            $penalite += 5000;
        }

        if ($pret->date_retour_reelle) {
          return redirect()->route('prets.index')->with('warning', 'Ce livre a déjà été retourné.');
}


        $pret->penalite = $penalite;

        $pret->save();

        return redirect()->route('prets.index')->with('success', 'Prêt mis à jour avec succès.');
    }

    public function destroy(Pret $pret)
    {
        $pret->delete();
        return back()->with('success', 'Prêt supprimé avec succès.');
    }

    public function retourner(Request $request, Pret $pret)
{
    if ($pret->date_retour_reelle) {
        return redirect()->route('prets.index')->with('warning', 'Ce livre a déjà été retourné.');
    }

    $request->validate([
        'date_retour_reel' => 'required|date',
        'etat_livre_retour' => 'required|in:bon,endommagé,perdu',
    ]);

    $pret->date_retour_reelle = $request->date_retour_reel;
    $pret->etat_retour = $request->etat_livre_retour;

    $penalite = 0;

    // Calcul de la pénalité en cas de retard
    if ($pret->date_retour) {
        $retard = Carbon::parse($pret->date_retour)->diffInDays($request->date_retour_reel, false);
        if ($retard < 0) {
            $penalite += abs($retard) * 500;
            $pret->statut = 'en retard';
        } else {
            $pret->statut = 'retourné';
        }
    }

    // Pénalité selon l’état du livre
    if ($request->etat_livre_retour === 'endommagé') {
        $penalite += 1000;
    } elseif ($request->etat_livre_retour === 'perdu') {
        $penalite += 5000;
    }

    $pret->penalite = $penalite;

    $pret->save();

    return redirect()->route('prets.index')->with('success', 'Livre retourné avec succès.');
}
    
}
