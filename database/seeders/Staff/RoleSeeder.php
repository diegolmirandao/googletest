<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\User\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::upsert([
            [
                'id' => 1,
                'name' => 'SUPER ADMINISTRADOR',
                'guard_name' => 'sanctum'
            ],
            [
                'id' => 2,
                'name' => 'ADMINISTRADOR',
                'guard_name' => 'sanctum'
            ],
            [
                'id' => 3,
                'name' => 'ASESOR',
                'guard_name' => 'sanctum'
            ],
        ], 'id');
    }
}
