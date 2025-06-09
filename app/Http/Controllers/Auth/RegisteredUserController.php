<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bibliotheque;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function create(): View
    { 
        $bibliotheques = Bibliotheque::all();
        return view('auth.register' , compact('bibliotheques'));
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:10'],
            'tel' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'bibliotheque_id' => ['required', 'integer', 'exists:bibliotheques,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'email' => $request->email,
            'bibliotheque_id'=> $request-> bibliotheque_id,
            'password' => Hash::make($request->password),
        ]);

       event(new Registered($user));

        // Optionnel : envoie un message d’information
        return redirect()->route('login')->with('status', 'Votre compte a été créé. Veuillez vérifier votre email. Il sera activé après validation par un administrateur.');

            }

  public function inactiveUsers()
    {
        $users = User::where('is_active', false)->paginate(10);
        return view('admin.users.inactive', compact('users'));
    }

    // Active un utilisateur
    public function activateUser(User $user)
    {
        $user->is_active = true;
        $user->save();

        return redirect()->route('admin.users.inactive')->with('success', 'Utilisateur activé avec succès.');
    }
}
