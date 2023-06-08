<?php

namespace Database\Seeders\Staff;

use App\Models\Staff\Service\BillingCycle;
use Illuminate\Database\Seeder;

class BillingCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillingCycle::upsert([
            [
                'id' => 1,
                'name' => 'PAGO UNICO',
                'period' => 0,
                'interval' => 'days'
            ],
            [
                'id' => 2,
                'name' => 'DIARIO',
                'period' => 1,
                'interval' => 'days'
            ],
            [
                'id' => 3,
                'name' => 'SEMANAL',
                'period' => 1,
                'interval' => 'weeks'
            ],
            [
                'id' => 4,
                'name' => 'MENSUAL',
                'period' => 1,
                'interval' => 'months'
            ],
            [
                'id' => 5,
                'name' => 'TRIMESTRAL',
                'period' => 3,
                'interval' => 'months'
            ],
            [
                'id' => 6,
                'name' => 'SEMESTRAL',
                'period' => 6,
                'interval' => 'months'
            ],
            [
                'id' => 7,
                'name' => 'ANUAL',
                'period' => 1,
                'interval' => 'years'
            ],
        ], 'id');
    }
}
