<?php

namespace Database\Seeders;

use App\Models\Product\ProductCostType;
use Illuminate\Database\Seeder;

class ProductCostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCostType::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'COSTO'
            ]
        );
    }
}
