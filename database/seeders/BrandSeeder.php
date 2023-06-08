<?php

namespace Database\Seeders;

use App\Models\Product\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'SIN MARCA'
            ]
        );
    }
}
