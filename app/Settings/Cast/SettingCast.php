<?php

namespace App\Settings\Cast;

use Spatie\LaravelSettings\SettingsCasts\SettingsCast;
use App\Settings\Setting;

class SettingCast implements SettingsCast
{
    public function get($payload): Setting
    {
        return new Setting($payload);
    }

    public function set($payload): array
    {
        return (array)$payload;
    }
}