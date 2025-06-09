<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\AbonneController;
use App\Http\Controllers\AbonnementController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PretController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::resource ('prets', PretController::class);

Route::get('/', function () {
    if (Auth::check()) {
        return view('welcome'); 
    } else {
        return view('auth.login'); // Utilisateur non connecté
    }
});


Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Routes pour l'enregistrement
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});


// Routes pour la connexion
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profil/modifier', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profil/modifier', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/reset-password/{token?}', [PasswordResetController::class, 'showResetForm'])->name('password.request');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

Route::get('forgot-password', function () {
    return view('auth.forgot-password'); // Crée cette vue si ce n'est pas encore fait
})->middleware('guest')->name('password.request');
// Envoie le lien par email
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');
// Affiche le formulaire pour demander le lien
Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');
Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

// Enregistre le nouveau mot de passe
Route::post('reset-password', [PasswordResetController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ressources principales
Route::resource('bibliotheques', BibliothequeController::class);
Route::resource('categories', CategorieController::class);
Route::resource('livres', LivreController::class);
Route::resource('abonnes', AbonneController::class);
Route::resource('abonnements', AbonnementController::class);

// Activation des abonnés
Route::post('/abonnes/{id}/activate', [AbonneController::class, 'activate'])->name('abonnes.activate');

// Renouvellement des abonnements
Route::patch('/abonnements/{id}/renouveler', [AbonnementController::class, 'renouveler'])->name('abonnements.renouveler');

// Finalisation d'abonnement
Route::get('abonnes/finaliser/{abonne}', [AbonneController::class, 'finaliserAbonnement'])->name('abonnes.finaliser');

// Notifications
Route::get('/notifications', function () {
    $notifications = DB::table('abonnements')
        ->join('abonnes', 'abonnes.id', '=', 'abonnements.abonne_id')
        ->whereDate('abonnements.date_fin', '<=', now()->addDays(7))
        ->select('abonnes.nom', 'abonnes.prenom', 'abonnements.date_fin')
        ->get()
        ->map(function ($abonnement) {
            return (object) [
                'message' => "L'abonnement de {$abonnement->nom} {$abonnement->prenom} expire le " . \Carbon\Carbon::parse($abonnement->date_fin)->format('d/m/Y'),
                'created_at' => now(),
            ];
        });

    return view('notifications.index', compact('notifications'));
})->name('notifications.index');

// Génération des PDF
Route::get('/abonnes/{abonne}/carte-abonnement', [AbonneController::class, 'generateCard'])->name('abonnes.carte_abonnement');
Route::get('/abonnes/{abonne}/carte-abonnement/telecharger', [AbonneController::class, 'downloadCard'])->name('abonnes.carte_abonnement.telecharger');
Route::get('/abonnements/{id}/carte', [AbonnementController::class, 'carte'])->name('abonnements.carte');
Route::get('/carte-abonnement/telecharger/{id}', [AbonnementController::class, 'genererCarte'])->name('abonnements.carte');
// Route::get('/abonnements/actifs', [DashboardController::class, 'actifs'])->name('abonnements.actifs');
// Route::get('/abonnements/expirés', [DashboardController::class, 'expires'])->name('abonnements.expires');

Route::get('/abonnements/actifs', [AbonnementController::class, 'actifs'])->name('abonnements.actifs');
Route::get('/abonnements/expires', [AbonnementController::class, 'expires'])->name('abonnements.expires');

Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
Route::get('/paiements/checkout/{abonnement_id}', [PaiementController::class, 'checkout'])->name('paiements.checkout');

Route::get('/paiements/success', [PaiementController::class, 'success']);
Route::get('/paiements/cancel', [PaiementController::class, 'cancel']);
Route::get('/paiement/{abonnement}/checkout', [PaiementController::class, 'checkout'])->name('paiement.checkout');
Route::put('/prets/{pret}/retour', [PretController::class, 'retourner'])->name('prets.retourner');
Route::get('/prets/{pret}/retour', [PretController::class, 'formRetour'])->name('prets.form_retour');
Route::put('/prets/{pret}/retourner', [PretController::class, 'retourner'])->name('prets.retourner');


// Page demandant de vérifier son adresse e-mail
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route appelée quand l’utilisateur clique sur le lien de vérification dans l’e-mail
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Vérifie l’e-mail
    return redirect('/welcome'); // Redirige après vérification
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route pour renvoyer un nouveau lien de vérification
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::middleware (['auth', 'role:SuperAdmin|AdminGodomey|AdminCalavi'])->group(function () {
    Route::get('/admin/users/inactive', [RegisteredUserController::class, 'inactiveUsers'])->name('admin.users.inactive');
    Route::post('/admin/users/{user}/activate', [RegisteredUserController::class, 'activateUser'])->name('admin.users.activate');
//  });
