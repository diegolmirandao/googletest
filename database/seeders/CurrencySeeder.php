<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'GUARANI',
                'code' => 'PYG',
                'abbreviation' => 'GS',
                'main' => 1
            ]
        );
    }
}
