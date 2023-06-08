<?php

namespace Database\Seeders;

use App\Models\Location\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zone::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'city_id' => 1,
                'code' => 'los lau',
                'name' => 'LOS LAURELES'
            ]
        );
    }
}
