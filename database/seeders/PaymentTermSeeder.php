<?php

namespace Database\Seeders;

use App\Models\PaymentTerm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentTerm::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'CONTADO'
            ]
        );
        PaymentTerm::firstOrCreate(
            [
                'id' => 2
            ],
            [
                'name' => 'CRÉDITO'
            ]
        );
    }
}
