<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Abonnement;
use Carbon\Carbon;
use App\Models\Bibliotheque;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistiques globales
        $totalAbonnements = Abonnement::count();
        $actifs = Abonnement::where('statut', 'Actif')->count();
        $expirés = Abonnement::where('statut', 'Inactif')->count();

        // 2. Abonnements expirant dans 7 jours
        $dateLimite = Carbon::now()->addDays(7);
        $abonnementsBientotExpirés = Abonnement::with(['abonne', 'bibliotheque']) // pour éviter les appels répétitifs
            ->where('statut', 'Actif')
            ->whereDate('date_fin', '<=', $dateLimite)
            ->get();

        // 3. Répartition des abonnements par bibliothèque
        $abonnementsParBibliotheque = DB::table('abonnements')
            ->join('bibliotheques', 'abonnements.bibliotheque_id', '=', 'bibliotheques.id')
            ->select('bibliotheques.nom', 'bibliotheques.ville', DB::raw('COUNT(abonnements.id) as total'))
            ->groupBy('bibliotheques.nom', 'bibliotheques.ville')
            ->get();

        // 4. Notifications des abonnements proches de l’expiration
        $notifications = DB::table('abonnements')
            ->join('abonnes', 'abonnes.id', '=', 'abonnements.abonne_id')
            ->whereDate('abonnements.date_fin', '<=', now()->addDays(7))
            ->select('abonnes.nom', 'abonnes.prenom', 'abonnements.date_fin')
            ->get()
            ->map(function ($abonnement) {
                return (object)[
                    'message' => "L'abonnement de {$abonnement->nom} {$abonnement->prenom} expire le " . Carbon::parse($abonnement->date_fin)->format('d/m/Y'),
                    'created_at' => now(),
                ];
            });

  $abonnesParVille = Bibliotheque::with(['abonnements' => function ($query) {
    $query->with('abonne');
}])->get()->groupBy('ville');

$expiresParVille = [
    'Godomey' => 0,
    'Calavi' => 0,
];

foreach ($abonnesParVille as $ville => $biblios) {
    foreach ($biblios as $biblio) {
        $expiresParVille[$ville] = $expiresParVille[$ville] ?? 0;
        $expiresParVille[$ville] += $biblio->abonnements->where('statut', 'Expiré')->count();
    }
}
$actifsParVille = [
    'Godomey' => 1,
    'Calavi' => 2,
];

foreach ($abonnesParVille as $ville => $biblios) {
    foreach ($biblios as $biblio) {
        $actifsParVille[$ville] = $actifsParVille[$ville] ?? 0;
        $actifsParVille[$ville] += $biblio->abonnements->where('statut', 'Actif')->count();
    }
}
// $expiresParVille = [
//     'Godomey' => 2,
//     'Calavi' => 1,
// ];

// $actifsParVille = [
//     'Godomey' => 4,
//     'Calavi' => 3,
// ];


        return view('dashboard.index', compact(
            'totalAbonnements',
            'actifs',
            'expirés',
            'abonnementsBientotExpirés',
            'abonnementsParBibliotheque',
            'notifications',
            'abonnesParVille',
            'actifsParVille',
            'expiresParVille'
        ));
    }

    public function actifs()
    {
        $abonnements = Abonnement::with(['abonne', 'bibliotheque'])
            ->where('statut', 'Actif')
            ->get();

        return view('abonnements.actifs', compact('abonnements'));
    }

    public function expires()
    {
        $abonnements = Abonnement::with(['abonne', 'bibliotheque'])
            ->where('statut', 'Inactif')
            ->get();

        return view('abonnements.expires', compact('abonnements'));
    }
}

