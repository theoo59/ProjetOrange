<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Services\MqttListener; // IMPORT DE LA CLASSE

class MqttListen extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Écoute les messages MQTT et met à jour la base de données';

    public function handle()
    {
        $listener = new MqttListener();
        $listener->subscribe();
    }
}
