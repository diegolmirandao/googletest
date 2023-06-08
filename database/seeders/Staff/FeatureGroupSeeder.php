<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Feature\FeatureGroup;

class FeatureGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeatureGroup::upsert([
            [
                'id' => 1,
                'name' => 'POS'
            ],
            [
                'id' => 2,
                'name' => 'FACTURACION'
            ],
            [
                'id' => 3,
                'name' => 'INVENTARIO'
            ],
            [
                'id' => 4,
                'name' => 'COMPRAS'
            ],
            [
                'id' => 5,
                'name' => 'CONFIGURACION'
            ],
        ], 'id');
    }
}
