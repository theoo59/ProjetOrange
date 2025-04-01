<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Services\MqttRelayServiceLiveObjects;

class RelayTtnToMosquitto extends Command
{
    protected $signature = 'mqtt:relay-liveobjects';
    protected $description = 'Relaye les messages de TTN vers Mosquitto';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(MqttRelayServiceLiveObjects $relayService)
    {
        $this->info('Démarrage du relay TTN → Mosquitto...');
        $relayService->relayMessages();
    }
}
