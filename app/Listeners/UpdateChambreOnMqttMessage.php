<?php

namespace App\Listeners;

use App\Events\MqttMessageReceived;
use App\Models\Chambre;

class UpdateChambreOnMqttMessage
{
    public function handle(MqttMessageReceived $event)
    {
        // Extraire les données de l'événement
        $device_id = $event->device_id;
        $payload = $event->payload;

        // Extraire les informations utiles du payload
        $alarm = $payload['ALARM'] ?? null;
        $battery = $payload['BAT_V'] ?? null;
        $door_status = $payload['DOOR_OPEN_STATUS'] ?? null;
        $door_open_times = $payload['DOOR_OPEN_TIMES'] ?? null;
        $last_door_duration = $payload['LAST_DOOR_OPEN_DURATION'] ?? null;

        // Vérifier que l'identifiant du capteur est présent
        if ($device_id) {
            // Mettre à jour la chambre associée au capteur
            Chambre::where('device_id', $device_id)
                ->update([
                    'effraction' => $alarm,
                ]);
        }
    }
}

