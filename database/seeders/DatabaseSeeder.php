<?php

namespace Database\Seeders;

use Database\Seeders\Staff\BillingCycleSeeder;
use Database\Seeders\Staff\BillStatusSeeder;
use Database\Seeders\Staff\BusinessServiceStatusSeeder;
use Database\Seeders\Staff\CurrencySeeder;
use Database\Seeders\Staff\FeatureGroupSeeder;
use Database\Seeders\Staff\FeatureSeeder;
use Database\Seeders\Staff\PaymentMethodSeeder;
use Database\Seeders\Staff\PermissionGroupSeeder;
use Database\Seeders\Staff\PermissionRoleSeeder;
use Database\Seeders\Staff\RoleSeeder;
use Database\Seeders\Staff\ServicePriceSeeder;
use Database\Seeders\Staff\ServicePriceTypeSeeder;
use Database\Seeders\Staff\ServiceSeeder;
use Database\Seeders\Staff\SettingSeeder;
use Database\Seeders\Staff\TicketDepartmentSeeder;
use Database\Seeders\Staff\TicketStatusSeeder;
use Database\Seeders\Staff\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->hasAttached(\App\Models\Role::inRandomOrder()->first())->create();
        // \App\Models\Ticket::factory(10)->has(\App\Models\TicketReply::factory()->count(3))->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,//comentar al entrar en producción para no sobre escribir usuarios
            FeatureGroupSeeder::class,
            FeatureSeeder::class,
            TicketDepartmentSeeder::class,
            TicketStatusSeeder::class,
            ServiceSeeder::class,
            CurrencySeeder::class,
            BillingCycleSeeder::class,
            ServicePriceTypeSeeder::class,
            ServicePriceSeeder::class,
            BusinessServiceStatusSeeder::class,
            BillStatusSeeder::class,
            PaymentMethodSeeder::class,
            PermissionGroupSeeder::class,
            PermissionRoleSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
