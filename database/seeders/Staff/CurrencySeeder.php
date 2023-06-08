<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::upsert([
            [
                'id' => 1,
                'name' => 'GUARANIES',
                'code' => 'PYG',
                'abbreviation' => 'GS',
                'main' => 1,
                'exchange_rate' => 1,
            ],
        ], 'id');
    }
}
