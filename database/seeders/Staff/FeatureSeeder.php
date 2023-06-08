<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Feature\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::upsert([
            [
                'id' => 1,
                'feature_group_id' => 1,
                'name' => 'VENTAS',
                'type' => 'boolean'
            ],
            [
                'id' => 2,
                'feature_group_id' => 2,
                'name' => 'VENTAS',
                'type' => 'boolean'
            ],
            [
                'id' => 3,
                'feature_group_id' => 2,
                'name' => 'CUENTAS A COBRAR',
                'type' => 'boolean'
            ],
            [
                'id' => 4,
                'feature_group_id' => 2,
                'name' => 'PAGOS DE CLIENTES',
                'type' => 'boolean'
            ],
            [
                'id' => 5,
                'feature_group_id' => 3,
                'name' => 'PRODUCTOS',
                'type' => 'boolean'
            ],
            [
                'id' => 6,
                'feature_group_id' => 3,
                'name' => 'TRANSLADOS',
                'type' => 'boolean'
            ],
            [
                'id' => 7,
                'feature_group_id' => 4,
                'name' => 'CUENTAS POR PAGAR',
                'type' => 'boolean'
            ],
            [
                'id' => 8,
                'feature_group_id' => 4,
                'name' => 'PAGOS A PROVEEDORES',
                'type' => 'boolean'
            ],
            [
                'id' => 9,
                'feature_group_id' => 5,
                'name' => 'SUCURSALES',
                'type' => 'numeric'
            ],
            [
                'id' => 10,
                'feature_group_id' => 5,
                'name' => 'DEPOSITOS',
                'type' => 'numeric'
            ],
        ], 'id');
    }
}
