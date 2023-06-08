<?php

namespace Database\Seeders;

use App\Models\Location\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'code' => 'PY',
                'name' => 'PARAGUAY'
            ]
        );
    }
}
