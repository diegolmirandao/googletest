<?php

namespace App\Traits;
use App\Models\Device;

trait HasSync {
    public function devices() {
        return $this->morphToMany(Device::class, 'synchronizable');
    }

    public function setSynced($deviceId) {
        $device = $this->devices()->where('device_id', $deviceId)->first();
        
        if($device) {
            $this->devices()->detach($deviceId);
        }
    }
}