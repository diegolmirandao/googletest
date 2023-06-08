<?php

namespace Database\Seeders;

use App\Models\Customer\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::firstOrCreate(
            [
                'id' => 1
            ],
            [
                'customer_category_id' => 1,
                'acquisition_channel_id' => 1,
                'name' => 'SIN NOMBRE',
                'identification_document' => '44444401',
                'email' => NULL,
                'birthday' => NULL,
                'address' => NULL,
            ]
        );
    }
}
