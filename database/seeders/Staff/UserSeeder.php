<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::upsert([
            [
                'id' => 1,
                'name' => 'root',
                'username' => 'root',
                'email' => 'root@root.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ],
        ], 'id');

        $user = User::find(1);
        $user->assignRole(1);
    }
}
