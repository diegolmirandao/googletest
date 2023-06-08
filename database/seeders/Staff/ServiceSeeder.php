<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Service\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::upsert([
            [
                'id' => 1,
                'name' => 'PLAN EMPRENDEDOR CADI'
            ],
            [
                'id' => 2,
                'name' => 'PLAN PYMES CADI'
            ],
            [
                'id' => 3,
                'name' => 'PLAN CORPORATIVO CADI'
            ],
            [
                'id' => 4,
                'name' => 'PLAN EJECUTIVO CADI'
            ],
        ], 'id');
    }
}
