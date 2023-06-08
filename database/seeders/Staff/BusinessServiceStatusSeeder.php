<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Business\BusinessServiceStatus;

class BusinessServiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessServiceStatus::upsert([
            [
                'id' => 1,
                'name' => 'PENDIENTE'
            ],
            [
                'id' => 2,
                'name' => 'ACTIVO'
            ],
            [
                'id' => 3,
                'name' => 'SUSPENDIDO'
            ],
            [
                'id' => 4,
                'name' => 'CANCELADO'
            ],
        ], 'id');
    }
}
