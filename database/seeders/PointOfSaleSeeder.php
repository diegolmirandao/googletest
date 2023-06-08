<?php

namespace Database\Seeders;

use App\Models\PointOfSale;
use Illuminate\Database\Seeder;

class PointOfSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PointOfSale::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'establishment_id' => 1,
                'number' => 1
            ]
        );
    }
}
