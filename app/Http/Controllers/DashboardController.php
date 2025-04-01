<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord en fonction du type d'utilisateur (administrateur ou technicien).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Vérifie si l'utilisateur est un administrateur
        if (Auth::guard('web')->check()) {
            // Administrateur
            return view('dashboard'); // Page pour les administrateurs
        }

        // Vérifie si l'utilisateur est un technicien
        if (Auth::guard('technicien')->check()) {
            // Technicien
            return view('technicien.technicien.dashboard'); // Page pour les techniciens
        }

        // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
        return redirect()->route('login');
    }
}
