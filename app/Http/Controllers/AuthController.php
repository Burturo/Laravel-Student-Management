<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash; // Ajoutez cette ligne

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentification réussie
            $user = Auth::user();

            // Vérification de l'utilisateur authentifié
            if ($user) {
                // Récupération des informations supplémentaires de la table Person
                $person = Person::where('userId', $user->id)->first();

                if ($person) {
                    // Stocker les informations dans la session
                    session([
                        'userId' => $user->id,
                        'type' => $person->Type
                    ]);
                }

                return redirect()->intended('dashboard');
            } else {
                // En cas d'échec de récupération de l'utilisateur
                return back()->withErrors([
                    'email' => 'Erreur de récupération de l\'utilisateur authentifié.',
                ]);
            }
        }

        // Authentification échouée
        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies sont incorrectes.',
        ]);
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'direction' => 'required|string|max:255',
        ], [
            'direction.required' => 'Veuillez sélectionner une direction',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Création de la personne associée
        $person = Person::create([
            'firstname' => $request->name,
            'email' => $request->email,
            'userId' => $user->id,
            'type' => $request->direction,
        ]);

        Auth::login($user);
        // Redirection après l'inscription réussie
        return redirect()->intended('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
