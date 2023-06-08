<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Business::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'EMPRESA'
            ]
        );
    }
}
