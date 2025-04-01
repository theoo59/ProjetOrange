<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrateur extends Authenticatable
{
    protected $table = 'administrateur';
    protected $primaryKey = 'idAdministrateur';
    public $timestamps = false;

    // Propriétés pour la table Administrateur
    protected $fillable = [
        'ldap', 'motdepasse'
    ];

    protected $hidden = [
        'motdepasse',  // Cache le mot de passe
    ];

    // Vous pouvez ajouter des méthodes pour faciliter l'authentification via LDAP si nécessaire
}
