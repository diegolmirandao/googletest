<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Bill\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::upsert([
            [
                'id' => 1,
                'name' => 'EFECTIVO'
            ],
            [
                'id' => 2,
                'name' => 'TRANSFERENCIA BANCARIA'
            ],
            [
                'id' => 3,
                'name' => 'DEPOSITO'
            ],
            [
                'id' => 4,
                'name' => 'TARJETA DE CRÉDITO'
            ],
            [
                'id' => 5,
                'name' => 'TARJETA DE DEBITO'
            ],
        ], 'id');
    }
}
