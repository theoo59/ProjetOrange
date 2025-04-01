<?php

return [
    'host' => env('MQTT_HOST', 'eu1.cloud.thethings.network'),
    'port' => env('MQTT_PORT', 1883),
    'username' => env('MQTT_USERNAME', ''),
    'password' => env('MQTT_PASSWORD', ''),
    'client_id' => env('MQTT_CLIENT_ID', 'laravel_' . uniqid()),
];