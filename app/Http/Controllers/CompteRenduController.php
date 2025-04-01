<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chambre;

class CompteRenduController extends Controller
{
    public function show($id)
    {
        $chambre = Chambre::find($id); // Trouver la chambre par ID

        return view('chambre.compterendu', compact('chambre')); // Afficher la vue compterendu.blade.php avec la chambre
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'compte_rendu' => 'required|string|min:5',
        ]);

        HistoriqueIntervention::create([
            'chambre_id' => $id,
            'compte_rendu' => $request->compte_rendu,
        ]);

        return redirect()->route('technicienDashboard')->with('success', 'Compte rendu enregistré avec succès.');
    }
}
