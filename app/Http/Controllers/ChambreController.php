<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chambre;


class ChambreController extends Controller
{ 
    // Méthode pour récupérer les coordonnées GPS de la chambre en effraction
    public function index()
    {
        // Recherche la chambre en effraction
        $chambre = Chambre::where('effraction', true)->first();

        if (!$chambre) {
            return response()->json(['message' => 'Aucune chambre en effraction trouvee.'], 404);
        }

        // Transmettre la variable $chambre à la vue
        return view('technicienDashboard', compact('chambre'));
    }

    // Méthode pour afficher la page de désactivation
    public function showDesactivationPage($id)
    {
        $chambre = Chambre::findOrFail($id); 

        // Vérifier si la chambre existe
        if (!$chambre) {
            return redirect()->route('technicienDashboard')->with('error', 'Chambre introuvable.');
        }

        return view('chambre.desactiver', compact('chambre')); 
    }

    // Méthode pour désactiver la chambre
    public function desactiver(Request $request, $id)
    {
        $chambre = Chambre::findOrFail($id);
        $chambre->statut_surveillance = 0;  // Mise à jour du statut de surveillance
        $chambre->save();

        return redirect()->route('technicienDashboard')->with('success', 'Chambre désactivée avec succès.');
    }

}
