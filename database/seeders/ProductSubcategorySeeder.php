<?php

namespace Database\Seeders;

use App\Models\Product\ProductSubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductSubcategory::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'product_category_id' => 1,
                'name' => 'SIN SUB CATEGORÍA'
            ]
        );
    }
}
