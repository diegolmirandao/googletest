<?php

namespace Database\Seeders;

use App\Models\Product\ProductPriceType;
use Illuminate\Database\Seeder;

class ProductPriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPriceType::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'MINORISTA'
            ]
        );
    }
}
