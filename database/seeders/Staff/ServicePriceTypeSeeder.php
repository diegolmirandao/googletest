<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Service\ServicePriceType;

class ServicePriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServicePriceType::upsert([
            [
                'id' => 1,
                'name' => 'ESTANDAR'
            ],
            [
                'id' => 2,
                'name' => 'PREFERENCIAL'
            ],
        ], 'id');
    }
}
