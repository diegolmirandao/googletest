<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'DEPOSITO'
            ]
        );
    }
}
