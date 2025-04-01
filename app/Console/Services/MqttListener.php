<?php 

namespace App\Console\Services;

use App\Models\Chambre;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttListener
{
    public function subscribe()
    {
        try {
            // 🔹 Configuration de la connexion pour Live Objects
            $connectionSettings = (new ConnectionSettings)
                ->setUsername('json+device')  // Remplacer par l'utilisateur Live Objects
                ->setPassword('3af32172473e4ea9a145a716a9dc3956')  // Remplacer par ta clé API Live Objects
                ->setUseTls(true)
                ->setTlsSelfSignedAllowed(true)
                ->setTlsCertificateAuthorityFile('C:\Users\t.anneron\certs\isrgrootx1.pem');  // Assure-toi que le chemin du certificat est correct
            
            // 🔹 Connexion à Live Objects via MQTT
            $mqtt = new MqttClient('liveobjects.orange-business.com', 8883, 'laravel-liveobjects-client', MqttClient::MQTT_3_1_1);
            $mqtt->connect($connectionSettings);

            // 🔹 Souscription au topic Live Objects
            $mqtt->subscribe('urn/lv/#', function (string $topic, string $message) {

                // 🔹 Décoder le message reçu (présumé en JSON)
                $data = json_decode($message, true);

                // 🔹 Vérifier que le message contient le payload nécessaire
                if (isset($data['uplink_message']['decoded_payload'])) {
                    $payload = $data['uplink_message']['decoded_payload'];

                    // 🔹 Extraire l'état de la porte et l'ID du device
                    $door_status = $payload['DOOR_OPEN_STATUS'] ?? null;  // L'état de la porte (ouverte ou fermée)
                    $device_id = $data['end_device_ids']['device_id'] ?? null;  // ID du capteur

                    // 🔹 Vérifier que le device_id et door_status existent
                    if ($device_id && $door_status !== null) {
                        // 🔹 Mettre à jour la chambre avec le statut de la porte (effraction)
                        Chambre::where('device_id', $device_id)
                            ->update([
                                'effraction' => $door_status  // Mise à jour de la colonne 'effraction'
                            ]);

                        \Log::info("✅ Effraction pour le device {$device_id} mise à jour avec la valeur : {$door_status}");
                    } else {
                        \Log::warning("🔴 Données manquantes : device_id ou DOOR_OPEN_STATUS.");
                    }
                }
            });

            // 🔹 Boucle d'écoute continue
            $mqtt->loop(true);

        } catch (\Exception $e) {
            // 🔹 Log des erreurs MQTT
            \Log::error('Erreur MQTT : ' . $e->getMessage());
        }
    }
}





