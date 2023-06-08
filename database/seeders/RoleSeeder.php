<?php

namespace Database\Seeders;

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
                'name' => 'super_admin',
                'guard_name' => 'sanctum'
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'guard_name' => 'sanctum'
            ],
        ], 'id');
    }
}
