<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Models\Abonne;
use App\Models\Bibliotheque;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class AbonnementController extends Controller
{
    public function index()
    {
        // Mise à jour automatique du statut des abonnements
        $abonnements = Abonnement::with('abonne')->get();

        foreach ($abonnements as $abonnement) {
            if (Carbon::now()->greaterThan($abonnement->date_fin)) {
                $abonnement->update(['statut' => 'Inactif']);
            }
        }

        return view('abonnements.index', compact('abonnements'));
    }

    public function create()
    {
        $abonnes = Abonne::all();
        $bibliotheques = Bibliotheque::all();
        return view('abonnements.create', compact('abonnes', 'bibliotheques'));
    }

    public function store(Request $request)
    {
        // ✅ Validation complète des champs
        $request->validate([
            'abonne_id' => 'required|exists:abonnes,id',
            'bibliotheque_id' => 'required|exists:bibliotheques,id',
            'date_abonnement' => 'required|date',
        ]);

        $date_fin = Carbon::parse($request->date_abonnement)->addYear();

        Abonnement::create([
            'abonne_id' => $request->abonne_id,
            'bibliotheque_id' => $request->bibliotheque_id,
            'date_abonnement' => $request->date_abonnement,
            'date_fin' => $date_fin,
            'statut' => 'Actif',
        ]);
        $abonnement = Abonnement::create($request->all());
        return view('paiement.fedapay_checkout', compact('abonnement'));
    }

    public function edit(Abonnement $abonnement)
    {
        $abonnes = Abonne::all();
        $bibliotheques = Bibliotheque::all();
        return view('abonnements.edit', compact('abonnement', 'abonnes', 'bibliotheques'));
    }

    public function update(Request $request, Abonnement $abonnement)
    {
        // ✅ Validation complète des champs pour la mise à jour
        $request->validate([
            'abonne_id' => 'required|exists:abonnes,id',
            'bibliotheque_id' => 'required|exists:bibliotheques,id',
            'date_abonnement' => 'required|date',
        ]);

        $date_fin = Carbon::parse($request->date_abonnement)->addYear();
        $statut = Carbon::now()->greaterThan($date_fin) ? 'Inactif' : 'Actif';

        $abonnement->update([
            'abonne_id' => $request->abonne_id,
            'bibliotheque_id' => $request->bibliotheque_id,
            'date_abonnement' => $request->date_abonnement,
            'date_fin' => $date_fin,
            'statut' => $statut,
        ]);

        return redirect()->route('abonnements.index')->with('success', 'Abonnement mis à jour avec succès.');
    }

    public function show(Abonnement $abonnement)
{
    return view('abonnements.show', compact('abonnement'));
}


    public function destroy(Abonnement $abonnement)
    {
        $abonnement->delete();
        return redirect()->route('abonnements.index')->with('success', 'Abonnement supprimé avec succès.');
    }

    public function renouveler($id)
{
    $abonnement = Abonnement::findOrFail($id);
    
    if ($abonnement->est_expire) {
        $abonnement->update([
            'date_abonnement' => now(),
            'date_fin' => now()->addYear(),
            'statut' => 'Actif'
        ]);
        
        return redirect()->back()->with('success', 'Abonnement renouvelé avec succès.');
    }

    return redirect()->back()->with('error', 'Cet abonnement est encore actif.');
}


      public function actifs()
    {
        $abonnements = Abonnement::where ('statut', 'Actif')->get();
     dd($abonnements->pluck('abonne.nom'));

        return view('abonnements.actifs', compact('abonnements'));
    }

    public function expires()
    {
        $abonnements = Abonnement::where('statut', 'Inactif')->get();
        return view('abonnements.expires', compact('abonnements'));
    }


public function carte($id)
{
    $abonnement = Abonnement::findOrFail($id);
    
    // Retourne une vue pour afficher ou générer la carte
    return view('abonnements.carte', compact('abonnement'));
}

public function genererCarte($id)
{
    $abonne = Abonne::findOrFail($id);

    $dateEmission = now();
    $dateExpiration = $dateEmission->copy()->addYear();

    // Formatage des dates
    $dateEmissionFormatted = $dateEmission->format('d/m/Y');
    $dateExpirationFormatted = $dateExpiration->format('d/m/Y');

    // Chemins des images
    $photoPath = public_path('storage/photos_abonnes/' . $abonne->photo);
    $logoPath = public_path('storage/logo/logo.png');

    // Fallback en cas de fichier manquant
    if (!file_exists($photoPath)) {
        $photoPath = public_path('default/photo.jpg');
    }
    if (!file_exists($logoPath)) {
        $logoPath = public_path('default/logo.png');
    }

    // Génération du QR Code
    $qrContent = "Carte d'abonnement officielle\nNom : {$abonne->nom} {$abonne->prenom}\nID : {$abonne->id}\nÉmise le : {$dateEmissionFormatted}\nAuthentifiée par : Bibliothèque Bénin Excellence";
    $qrCodeUrl = 'data:image/png;base64,' . base64_encode(
    QrCode::format('png')->size(120)->generate($qrContent)
    );

        // Tu verras maintenant ce dd s’afficher
    // dd([
    //     'abonne' => $abonne,
    //     'dateEmission' => $dateEmission,
    //     'dateExpiration' => $dateExpirationFormatted,
    //     'photoPath' => $photoPath,
    //     'logoPath' => $logoPath,
    //     'qrCode' => $qrCodeUrl,
    // ]);
    // Rendu PDF
    $pdf = Pdf::loadView('abonnements.carte', [
        'abonne' => $abonne,
        'dateEmission' => $dateEmissionFormatted,
        'dateExpiration' => $dateExpirationFormatted,
        'photoPath' => $photoPath,
        'logoPath' => $logoPath,
        'qrCode' => $qrCodeUrl,
        'nomBibliotheque' => 'Bibliothèque BENIN EXCELLENCE',
    ])->setPaper([0, 0, 297.64, 419.53]); // A6 en points (mm × 2.835)
    return $pdf->download('carte_abonnement_' . $abonne->nom . '.pdf');
}

}
