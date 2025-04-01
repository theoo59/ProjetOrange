<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class CheckPasswordHash extends Command
{
    protected $signature = 'check:password-hash {ldap} {motdepasse}';
    protected $description = 'Vérifie le hachage du mot de passe pour un administrateur';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ldap = $this->argument('ldap');
        $password = $this->argument('motdepasse');

        $this->info("Recherche de l'administrateur avec l'identifiant LDAP : " . $ldap);

        $admin = Administrateur::where('ldap', $ldap)->first();

        if (!$admin) {
            $this->error('Administrateur non trouvé.');
            return;
        }
        $this->info("Administrateur trouvé : " . $admin->ldap);

        if (Hash::check($password, $admin->motdepasse)) {
            $this->info('Le mot de passe est correctement haché.');
        } else {
            $this->error('Le mot de passe ne correspond pas au hachage stocké.');
        }
    }
}

