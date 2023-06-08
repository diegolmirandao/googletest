<?php

namespace Database\Seeders;

use App\Models\Supplier\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'SIN NOMBRE',
                'identification_document' => '44444401',
                'email' => NULL,
                'address' => NULL,
            ]
        );
    }
}
