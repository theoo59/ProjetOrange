<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Administrateur;
use App\Models\Technicien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'ldap' => 'required|digits:8',
            'password' => 'required'
        ]);

        // Chercher l'utilisateur
        $user = Administrateur::where('ldap', $request->ldap)->first() 
            ?? Technicien::where('ldap', $request->ldap)->first();

        if (!$user) {
            Log::error('Utilisateur non trouvé', ['ldap' => $request->ldap]);
            return back()->withErrors(['ldap' => 'Utilisateur non trouvé.']);
        }

        // Déterminer le guard
        $guard = $user instanceof Administrateur ? 'web' : 'technicien';
        
        // Vérification manuelle du mot de passe
        if (!Hash::check($request->password, $user->motdepasse)) {
            Log::error('Mot de passe incorrect', [
                'ldap' => $request->ldap,
                'guard' => $guard
            ]);
            return back()->withErrors(['password' => 'Mot de passe incorrect.']);
        }

        // Connexion manuelle
        Auth::guard($guard)->login($user);

        $request->session()->regenerate();

        Log::info('Connexion réussie', [
            'guard' => $guard,
            'user_id' => $user->idTechnicien ?? $user->id,
            'ldap' => $user->ldap
        ]);

        // Redirection basée sur le guard
        return $guard === 'web' 
            ? redirect()->route('dashboard')
            : redirect()->route('technicienDashboard');
    }
    public function logout(Request $request)
    {
        if (Auth::guard('technicien')->check()) {
            Auth::guard('technicien')->logout(); // Déconnexion du technicien
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout(); // Déconnexion de l'administrateur
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Assure-toi que la vue login.blade.php existe dans resources/views/
    }
}






