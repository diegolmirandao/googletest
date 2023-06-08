<?php

namespace Database\Seeders\Staff;

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
                'name' => 'EMPRESAS',
            ],
            [
                'id' => 2,
                'name' => 'SERVICIOS EMPRESAS',
            ],
            [
                'id' => 3,
                'name' => 'FACTURAS',
            ],
            [
                'id' => 4,
                'name' => 'TICKETS',
            ],
            [
                'id' => 5,
                'name' => 'SERVICIOS',
            ],
            [
                'id' => 6,
                'name' => 'USUARIOS',
            ],
            [
                'id' => 7,
                'name' => 'PERMISOS',
            ],
            [
                'id' => 8,
                'name' => 'ROLES',
            ]
        ], 'id');
    }
}
