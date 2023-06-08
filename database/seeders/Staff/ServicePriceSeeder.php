<?php

namespace Database\Seeders\Staff;

use Illuminate\Database\Seeder;
use App\Models\Staff\Service\ServicePrice;

class ServicePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServicePrice::upsert([
            [
                'id' => 1,
                'service_id' => 1,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 4,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 200000
            ],
            [
                'id' => 2,
                'service_id' => 1,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 5,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 540000
            ],
            [
                'id' => 3,
                'service_id' => 1,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 6,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 1020000
            ],
            [
                'id' => 4,
                'service_id' => 1,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 7,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 1920000
            ],
            [
                'id' => 5,
                'service_id' => 2,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 4,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 350000
            ],
            [
                'id' => 6,
                'service_id' => 2,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 5,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 945000
            ],
            [
                'id' => 7,
                'service_id' => 2,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 6,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 1785000
            ],
            [
                'id' => 8,
                'service_id' => 2,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 7,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 3360000
            ],
            [
                'id' => 9,
                'service_id' => 3,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 4,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 500000
            ],
            [
                'id' => 10,
                'service_id' => 3,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 5,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 1350000
            ],
            [
                'id' => 11,
                'service_id' => 3,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 6,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 2550000
            ],
            [
                'id' => 12,
                'service_id' => 3,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 7,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 4800000
            ],
            [
                'id' => 13,
                'service_id' => 4,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 4,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 0
            ],
            [
                'id' => 14,
                'service_id' => 4,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 5,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 0
            ],
            [
                'id' => 15,
                'service_id' => 4,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 6,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 0
            ],
            [
                'id' => 16,
                'service_id' => 4,
                'service_price_type_id' => 1,
                'billing_cycle_id' => 7,
                'currency_id' => 1,
                'trial_period' => 1,
                'trial_interval' => 'months',
                'grace_period' => 10,
                'grace_interval' => 'days',
                'bill_generation_period' => 10,
                'bill_generation_interval' => 'days',
                'amount' => 0
            ],
        ], 'id');
    }
}
