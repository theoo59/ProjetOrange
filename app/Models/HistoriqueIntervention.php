<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueIntervention extends Model
{
    use HasFactory;

    protected $table = 'historique_intervention';
    protected $fillable = ['chambre_id', 'compte_rendu'];
}
