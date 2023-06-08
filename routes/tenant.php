<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Broadcast::routes(['middleware' => [
    'api',
    InitializeTenancyByRequestData::class
]]);

Route::group(['prefix' => config('sanctum.prefix', 'sanctum')], static function () {
    Route::get('/csrf-cookie', [CsrfCookieController::class, 'show'])
        ->middleware([
            'universal',
            InitializeTenancyByRequestData::class // Use tenancy initialization middleware of your choice
        ])->name('sanctum.csrf-cookie');
});

Route::middleware([
    'api',
    InitializeTenancyByRequestData::class
])->group(function () {
    Route::post("/login", "App\Http\Controllers\LoginController@login")->name('login')->middleware('user_device');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get("/logout", "App\Http\Controllers\LoginController@logout")->name('logout');
        Route::get("init", "App\Http\Controllers\InitController@init")->name('init');
        
        // Sync routes 
        Route::get("sync/{deviceId}", "App\Http\Controllers\SyncController@sync");

        //Config Routes
        Route::apiResource('businesses', 'App\Http\Controllers\BusinessController');
        Route::apiResource('establishments.points-of-sale', 'App\Http\Controllers\PointOfSaleController');
        Route::apiResource('establishments', 'App\Http\Controllers\EstablishmentController');
        Route::apiResource('warehouses', 'App\Http\Controllers\WarehouseController');
        Route::apiResource('currencies', 'App\Http\Controllers\CurrencyController');
        Route::apiResource('payment-terms', 'App\Http\Controllers\PaymentTermController');
        Route::apiResource('payment-methods', 'App\Http\Controllers\PaymentMethodController');
        Route::apiResource('document-types', 'App\Http\Controllers\DocumentTypeController');

        //Location routes
        Route::apiResource('countries', 'App\Http\Controllers\Location\CountryController');
        Route::apiResource('regions', 'App\Http\Controllers\Location\RegionController');
        Route::apiResource('cities', 'App\Http\Controllers\Location\CityController');
        Route::apiResource('zones', 'App\Http\Controllers\Location\ZoneController');

        //Users routes
        Route::apiResource('users', 'App\Http\Controllers\User\UserController');
        Route::apiResource('roles', 'App\Http\Controllers\User\RoleController')->only(['index']);
        Route::apiResource('permission-groups', 'App\Http\Controllers\User\PermissionGroupController')->only('index');
        Route::apiResource('permissions', 'App\Http\Controllers\User\PermissionController');

        //Products routes
        Route::apiResource('product-categories.subcategories', 'App\Http\Controllers\Product\ProductSubcategoryController')->only(['store', 'update', 'destroy']);
        Route::apiResource('product-categories', 'App\Http\Controllers\Product\ProductCategoryController');
        Route::apiResource('product-types', 'App\Http\Controllers\Product\ProductTypeController')->only(['index']);
        Route::apiResource('brands', 'App\Http\Controllers\Product\BrandController');
        Route::apiResource('measurement-units', 'App\Http\Controllers\Product\MeasurementUnitController');
        Route::apiResource('variants.options', 'App\Http\Controllers\Product\VariantOptionController')->only(['store', 'update', 'destroy']);
        Route::apiResource('variants', 'App\Http\Controllers\Product\VariantController');
        Route::apiResource('properties.options', 'App\Http\Controllers\Product\PropertyOptionController')->only(['store', 'update', 'destroy']);
        Route::apiResource('properties', 'App\Http\Controllers\Product\PropertyController');
        Route::apiResource('product-price-types', 'App\Http\Controllers\Product\ProductPriceTypeController');
        Route::apiResource('product-cost-types', 'App\Http\Controllers\Product\ProductCostTypeController');
        Route::apiResource('products.details.costs', 'App\Http\Controllers\Product\ProductDetailCostController')->only(['store', 'update', 'destroy']);
        Route::apiResource('products.details.prices', 'App\Http\Controllers\Product\ProductDetailPriceController')->only(['store', 'update', 'destroy']);
        Route::get('product-details', 'App\Http\Controllers\Product\ProductDetailController@index');
        Route::apiResource('products.details', 'App\Http\Controllers\Product\ProductDetailController')->only(['store', 'show', 'update', 'destroy']);
        Route::apiResource('products', 'App\Http\Controllers\Product\ProductController');

        //Customer routes
        Route::apiResource('customer-categories', 'App\Http\Controllers\Customer\CustomerCategoryController');
        Route::apiResource('acquisition-channels', 'App\Http\Controllers\Customer\AcquisitionChannelController');
        Route::apiResource('customer-reference-types', 'App\Http\Controllers\Customer\CustomerReferenceTypeController');
        Route::apiResource('customers.billing-addresses', 'App\Http\Controllers\Customer\CustomerBillingAddressController')->only(['store', 'update', 'destroy']);
        Route::apiResource('customers.references', 'App\Http\Controllers\Customer\CustomerReferenceController')->only(['store', 'update', 'destroy']);
        Route::apiResource('customers.addresses', 'App\Http\Controllers\Customer\CustomerAddressController')->only(['store', 'update', 'destroy']);
        Route::apiResource('customers', 'App\Http\Controllers\Customer\CustomerController');

        //Sales routes
        Route::apiResource('sales.products', 'App\Http\Controllers\Sale\SaleProductController')->only(['store', 'update', 'destroy']);
        Route::apiResource('sales.payments', 'App\Http\Controllers\Sale\SalePaymentController')->only(['store', 'update', 'destroy']);
        Route::put("sales/{sale}/instalments", "App\Http\Controllers\Sale\SaleInstalmentController@update")->name('sales.instalments.update');
        Route::apiResource('sales', 'App\Http\Controllers\Sale\SaleController');

        Route::get('accounts-receivable', 'App\Http\Controllers\Sale\AccountReceivableController@index');
        Route::apiResource('customer-payments', 'App\Http\Controllers\Sale\CustomerPaymentController');

        //Supplier routes
        Route::apiResource('suppliers.contacts', 'App\Http\Controllers\Supplier\SupplierContactController')->only(['store', 'update', 'destroy']);
        Route::apiResource('suppliers.addresses', 'App\Http\Controllers\Supplier\SupplierAddressController')->only(['store', 'update', 'destroy']);
        Route::apiResource('suppliers', 'App\Http\Controllers\Supplier\SupplierController');

        //Purchases routes
        Route::apiResource('purchases.products', 'App\Http\Controllers\Purchase\PurchaseProductController')->only(['store', 'update', 'destroy']);
        Route::apiResource('purchases.payments', 'App\Http\Controllers\Purchase\PurchasePaymentController')->only(['store', 'update', 'destroy']);
        Route::put("purchases/{purchase}/instalments", "App\Http\Controllers\Purchase\PurchaseInstalmentController@update")->name('purchases.instalments.update');
        Route::apiResource('purchases', 'App\Http\Controllers\Purchase\PurchaseController');

        Route::get('accounts-payable', 'App\Http\Controllers\Purchase\AccountPayableController@index');
        Route::apiResource('supplier-payments', 'App\Http\Controllers\Purchase\SupplierPaymentController');
      
        //Sale orders routes
        Route::get('sale-order-statuses', 'App\Http\Controllers\SaleOrder\SaleOrderStatusController@index');
        Route::put('sale-orders/{sale_order}/products/cancel/{product}', 'App\Http\Controllers\SaleOrder\SaleOrderProductController@cancel')->name('sale-orders.products.cancel');
        Route::apiResource('sale-orders.products', 'App\Http\Controllers\SaleOrder\SaleOrderProductController')->only(['store', 'update', 'destroy']);
        Route::put('sale-orders/cancel/{sale_order}', 'App\Http\Controllers\SaleOrder\SaleOrderController@cancel')->name('sale-orders.cancel');
        Route::apiResource('sale-orders', 'App\Http\Controllers\SaleOrder\SaleOrderController');
    });
});