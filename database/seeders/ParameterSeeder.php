<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parameter::upsert([
            [
                'id' => 1,
                'parameter_group_id' => 1,
                'name' => 'product.minimum_stock'
            ],
            [
                'id' => 2,
                'parameter_group_id' => 1,
                'name' => 'product.maximum_stock'
            ],
        ], 'id');
    }
}
