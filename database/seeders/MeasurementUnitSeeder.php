<?php

namespace Database\Seeders;

use App\Models\Product\MeasurementUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeasurementUnit::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'id' => 1,
                'name' => 'UNIDAD',
                'abbreviation' => 'UN'
            ]
        );
    }
}
