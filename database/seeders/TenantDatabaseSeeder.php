<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,//comentar al entrar en producción para no sobre escribir usuarios
            PermissionGroupSeeder::class,
            PermissionRoleSeeder::class,
            BusinessSeeder::class,
            EstablishmentSeeder::class,
            PointOfSaleSeeder::class,
            WarehouseSeeder::class,
            PaymentTermSeeder::class,
            PaymentMethodSeeder::class,
            DocumentTypeSeeder::class,
            CurrencySeeder::class,
            CurrencyExchangeRateSeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            ZoneSeeder::class,
            ParameterGroupSeeder::class,
            ParameterSeeder::class,
            ProductCategorySeeder::class,
            ProductSubcategorySeeder::class,
            BrandSeeder::class,
            ProductTypeSeeder::class,
            MeasurementUnitSeeder::class,
            ProductPriceTypeSeeder::class,
            ProductCostTypeSeeder::class,
            CustomerCategorySeeder::class,
            AcquisitionChannelSeeder::class,
            CustomerReferenceTypeSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            SaleOrderStatusSeeder::class,
        ]);
    }
}
