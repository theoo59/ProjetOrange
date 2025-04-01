<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Technicien;
use App\Models\Chambre; // Ajout du modèle Chambre
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TechnicienAuthController extends Controller
{
    public function index()
    {
        // Vérification explicite de l'authentification
        if (!Auth::guard('technicien')->check()) {
            Log::error('Tentative d\'accès au dashboard sans authentification');
            return redirect()->route('login');
        }

        $technicien = Auth::guard('technicien')->user();

        if (!$technicien) {
            return redirect()->route('login')->withErrors(['error' => 'Utilisateur non trouvé.']);
        }

        // Vérifier si le technicien a un secteur assigné
        if (!$technicien->Secteur_idSecteur) {
            return back()->with('error', 'Aucun secteur assigné.');
        }

        // Récupérer les chambres du secteur du technicien
        $chambres = Chambre::where('Secteur_idSecteur', $technicien->Secteur_idSecteur)->get();

        // Debug : Vérifier si les chambres sont bien récupérées
        Log::info('Accès au dashboard technicien', [
            'technicien_id' => $technicien->idTechnicien,
            'nom' => $technicien->nom,
            'prenom' => $technicien->prenom,
            'chambres_count' => $chambres->count()
        ]);

        return view('technicienDashboard', compact('technicien', 'chambres'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::guard('technicien')->logout();
        return redirect()->route('login');
    }
}

