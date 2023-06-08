<?php

namespace Database\Seeders;

use App\Models\Establishment;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Establishment::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'business_id' => 1,
                'name' => 'SUCURSAL'
            ]
        );
    }
}
