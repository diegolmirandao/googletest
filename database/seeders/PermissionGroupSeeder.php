<?php

namespace Database\Seeders;

use App\Models\User\PermissionGroup;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionGroup::upsert([
            [
                'id' => 1,
                'name' => 'permission_groups',
            ],
            [
                'id' => 2,
                'name' => 'currencies',
            ],
            [
                'id' => 3,
                'name' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'products',
            ],
            [
                'id' => 5,
                'name' => 'customers',
            ],
            [
                'id' => 6,
                'name' => 'VENTAS',
            ],
            [
                'id' => 7,
                'name' => 'PROVEEDORES',
            ],
            [
                'id' => 8,
                'name' => 'COMPRAS',
            ],
            [
                'id' => 9,
                'name' => 'ORDENES DE VENTA',
            ],
        ], 'id');
    }
}
