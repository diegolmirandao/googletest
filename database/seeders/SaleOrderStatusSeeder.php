<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaleOrder\SaleOrderStatus;

class SaleOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleOrderStatus::upsert([
            [
                'id' => 1,
                'name' => 'PENDIENTE'
            ],
            [
                'id' => 2,
                'name' => 'PROCESADA PARCIALMENTE'
            ],
            [
                'id' => 3,
                'name' => 'PROCESADA'
            ],
            [
                'id' => 4,
                'name' => 'CANCELADA'
            ]
        ], 'id');
    }
}
