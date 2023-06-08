<?php

namespace Database\Seeders;

use App\Models\ParameterGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParameterGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParameterGroup::upsert([
            [
                'id' => 1,
                'name' => 'products'
            ],
        ], 'id');
    }
}
