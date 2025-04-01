<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    public $timestamps = false; 

    use HasFactory;
    protected $table = 'chambre';
    protected $primaryKey = 'idChambre'; 
    protected $fillable = ['idChambre', 'latitude', 'longitude', 'Secteur_idSecteur'];}
