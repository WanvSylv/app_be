<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifie l'utilisateur
        $request->authenticate();

        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Vérifie si l'adresse e-mail est confirmée
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Vous devez vérifier votre adresse e-mail avant de vous connecter.',
            ]);
        }

        // Vérifie si le compte est activé par l'admin
        if (!$user->is_active) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Votre compte n’a pas encore été activé par l’administrateur.',
            ]);
        }

        // Régénère la session si tout est ok
        $request->session()->regenerate();

        return redirect()->intended(route('welcome'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

