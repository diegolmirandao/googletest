<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use Spatie\LaravelSettings\Models\SettingsProperty;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsProperty::upsert([
            [
                'group' => 'general',
                'name' => 'date_format',
                'locked' => false,
                'payload' => json_encode(['type' => 'select', 'options' => ['dd-mm-yyyy', 'yyyy-mm-dd', 'mm-dd-yyyy'], 'value' => 'dd-mm-yyyy'])
            ],
            [
                'group' => 'general',
                'name' => 'thousand_separator',
                'locked' => false,
                'payload' => json_encode(['type' => 'text', 'options' => null, 'value' => '.'])
            ],
            [
                'group' => 'general',
                'name' => 'decimals',
                'locked' => false,
                'payload' => json_encode(['type' => 'int', 'options' => null, 'value' => 0])
            ],
            [
                'group' => 'general',
                'name' => 'decimal_separator',
                'locked' => false,
                'payload' => json_encode(['type' => 'text', 'options' => null, 'value' => ','])
            ]
        ], 'name');
    }
}
