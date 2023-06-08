<?php

namespace App\Settings;

use App\Settings\Cast\SettingCast;
use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    /** @var Setting */
    public $date_format, $thousand_separator, $decimals, $decimal_separator;

    public static function group(): string
    {
        return 'general';
    }

    public static function casts(): array
    {
        return [
            'date_format' => SettingCast::class,
            'thousand_separator' => SettingCast::class,
            'decimals' => SettingCast::class,
            'decimal_separator' => SettingCast::class,
        ];
    }
}