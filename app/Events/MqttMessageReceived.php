<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MqttMessageReceived
{
    use Dispatchable, SerializesModels;

    public $device_id;
    public $payload;

    public function __construct($device_id, $payload)
    {
        $this->device_id = $device_id;
        $this->payload = $payload;
    }
}
