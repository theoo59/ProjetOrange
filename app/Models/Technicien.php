<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Technicien extends Authenticatable
{
    protected $table = 'technicien'; // Assurez-vous que c'est le bon nom de table
    protected $primaryKey = 'idTechnicien'; // Votre clé primaire

    protected $fillable = [
        'ldap', 'nom', 'prenom', 'motdepasse', 'numerotelephone', 'Secteur_idSecteur'
    ];

    protected $hidden = [
        'motdepasse'
    ];

    // Méthode pour l'authentification
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }

    // Personnalisez la méthode d'authentification si nécessaire
    public function getAuthIdentifierName()
    {
        return 'ldap';
    }

    public function getAuthIdentifier()
    {
        return $this->ldap;
    }
}
