<?php

namespace Database\Seeders;

use App\Models\Location\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'region_id' => 1,
                'code' => 'ASU',
                'name' => 'ASUNCIÓN'
            ]
        );
    }
}
