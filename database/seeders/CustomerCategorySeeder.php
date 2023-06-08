<?php

namespace Database\Seeders;

use App\Models\Customer\CustomerCategory;
use Illuminate\Database\Seeder;

class CustomerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerCategory::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => 'SIN CATEGORÍA'
            ]
        );
    }
}
