<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Bill\BillStatus;

class BillStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillStatus::upsert([
            [
                'id' => 1,
                'name' => 'PENDIENTE'
            ],
            [
                'id' => 2,
                'name' => 'PAGADA PARCIALMENTE'
            ],
            [
                'id' => 3,
                'name' => 'PAGADA'
            ],
            [
                'id' => 4,
                'name' => 'ANULADA'
            ],
            [
                'id' => 5,
                'name' => 'VENCIDO'
            ],
            [
                'id' => 6,
                'name' => 'PAGO DEVUELTO'
            ],
        ], 'id');
    }
}
