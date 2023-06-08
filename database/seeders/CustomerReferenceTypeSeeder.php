<?php

namespace Database\Seeders;

use App\Models\Customer\CustomerReferenceType;
use Illuminate\Database\Seeder;

class CustomerReferenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerReferenceType::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'REFERENCIA PERSONAL'
            ]
        );
    }
}
