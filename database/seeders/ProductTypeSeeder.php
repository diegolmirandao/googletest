<?php

namespace Database\Seeders;

use App\Models\Product\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::upsert([
            [
                'id' => 1,
                'name' => 'PRODUCTO'
            ],
            [
                'id' => 2,
                'name' => 'SERVICIO'
            ],
            [
                'id' => 3,
                'name' => 'PRODUCTO ELABORADO'
            ],
            [
                'id' => 4,
                'name' => 'INSUMO'
            ],
            [
                'id' => 5,
                'name' => 'INSUMO ELABORADO'
            ],
            [
                'id' => 6,
                'name' => 'MANO DE OBRA'
            ],
            [
                'id' => 7,
                'name' => 'ACTIVO'
            ],
        ], 'id');
    }
}
