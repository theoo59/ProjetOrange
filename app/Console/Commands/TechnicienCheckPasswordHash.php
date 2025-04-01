<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Technicien;
use Illuminate\Support\Facades\Hash;

class TechnicienCheckPasswordHash extends Command
{
    protected $signature = 'check:password-hash {ldap} {motdepasse}';
    protected $description = 'Vérifie le hachage du mot de passe pour un technicien';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ldap = $this->argument('ldap');
        $password = $this->argument('motdepasse');

        $this->info("Recherche du techinicien avec l'identifiant LDAP : " . $ldap);

        $technicien = Technicien::where('ldap', $ldap)->first();

        if (!$technicien) {
            $this->error('Technicien non trouvé.');
            return;
        }
        $this->info("Technicien trouvé : " . $technicien->ldap);

        if (Hash::check($password, $technicien->motdepasse)) {
            $this->info('Le mot de passe est correctement haché.');
        } else {
            $this->error('Le mot de passe ne correspond pas au hachage stocké.');
        }
    }
}

