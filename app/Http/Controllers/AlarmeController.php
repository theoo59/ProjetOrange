<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlarmeController extends Controller
{
    public function showDisableForm()
    {
        return view('alarm.disable');
    }

    public function disable(Request $request)
    {
        // Valider la requête
        $request->validate([
            // Ajoutez des règles de validation si nécessaire
        ]);

        // Logique pour désactiver l'alarme
        // Par exemple :
        // AlarmSystem::disable();
        
        return redirect()->route('dashboard')->with('status', 'Alarme désactivée avec succès');
    }
}