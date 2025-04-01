<?php

namespace App\Console\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\ConnectionSettings;
use Illuminate\Support\Facades\Log;


class MqttRelayServiceLiveObjects
{
    private $liveObjectsClient;
    private $mosquittoClient;

    public function __construct()
    {
        // 🔹 Configuration de la connexion MQTT pour Live Objects
        $apiKey = '3af32172473e4ea9a145a716a9dc3956'; // Remplace par ta clé API Live Objects
        $broker = 'liveobjects.orange-business.com';
        $port = 8883; // 8883 si TLS

        $connectionSettings = (new ConnectionSettings)
            ->setUsername('json+device')
            ->setPassword($apiKey)
            ->setKeepAliveInterval(60)
            ->setUseTls(true); // Passe à true si tu utilises le port 8883 (SSL)

        // 🔹 Connexion au broker Live Objects
        $this->liveObjectsClient = new MqttClient($broker, $port, 'laravel-liveobjects-client', MqttClient::MQTT_3_1_1);
        $this->liveObjectsClient->connect($connectionSettings);

        if ($this->liveObjectsClient->isConnected()) {
            Log::info("✅ Connexion à Live Objects réussie !");
            echo "✅ Connexion à Live Objects réussie !\n";
        } else {
            Log::error("❌ Échec de la connexion à Live Objects !");
            echo "❌ Échec de la connexion à Live Objects !\n";
        }

        // 🔹 Configuration de la connexion MQTT pour Mosquitto
        $this->mosquittoClient = new MqttClient('127.0.0.1', 8883, 'laravel-mosquitto-client');
        $this->mosquittoClient->connect();

        if ($this->mosquittoClient->isConnected()) {
            Log::info("✅ Connexion à Mosquitto réussie !");
            echo "✅ Connexion à Mosquitto réussie !\n";
        } else {
            Log::error("❌ Échec de la connexion à Mosquitto !");
            echo "❌ Échec de la connexion à Mosquitto !\n";
        }
    }

    public function relayMessages()
    {
        Log::info("📡 Tentative de souscription au topic Live Objects...");
        echo "📡 Tentative de souscription au topic Live Objects...\n";

        try {
            // 🔹 Souscription au topic Live Objects
            $this->liveObjectsClient->subscribe('urn/lv/#', function (string $topic, string $message) {
                Log::info("✅ Message reçu de Live Objects : {$message}");
                echo "✅ Message reçu de Live Objects : {$message}\n";

                // 🔹 Republier sur Mosquitto
                $this->mosquittoClient->publish('liveobjects/devices/+/up', $message);
            }, 0);

            Log::info("✅ Souscription réussie au topic Live Objects.");
            echo "✅ Souscription réussie au topic Live Objects.\n";

        } catch (\Exception $e) {
            Log::error("❌ Erreur lors de la souscription au topic Live Objects : " . $e->getMessage());
            echo "❌ Erreur lors de la souscription au topic Live Objects : " . $e->getMessage() . "\n";
        }

        // 🔹 Boucle d'écoute pour MQTT
        while (true) {
            try {
                $this->liveObjectsClient->loop();
                $this->mosquittoClient->loop();
                usleep(100000); // Petite pause pour éviter la surcharge CPU
            } catch (\Exception $e) {
                Log::error("❌ Erreur dans la boucle : " . $e->getMessage());
                echo "❌ Erreur dans la boucle : " . $e->getMessage() . "\n";
                break; // Arrêter la boucle en cas d'erreur
            }
        }
    }

    public function __destruct()
    {
        $this->liveObjectsClient->disconnect();
        $this->mosquittoClient->disconnect();
    }
}
