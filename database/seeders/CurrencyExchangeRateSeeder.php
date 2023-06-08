<?php

namespace Database\Seeders;

use App\Models\CurrencyExchangeRate;
use Illuminate\Database\Seeder;

class CurrencyExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyExchangeRate::firstOrCreate(
        [
            'id' => 1
        ],
        [
            'currency_id' => 1,
            'exchange_rate' => 1
        ]
    );
    }
}
