<?php

namespace Database\Seeders;

use App\Models\Location\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'country_id' => 1,
                'code' => '1',
                'name' => 'CENTRAL'
            ]
        );
    }
}
