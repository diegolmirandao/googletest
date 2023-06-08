<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", "App\Http\Controllers\LoginController@login")->name('login');
Route::get("identify-tenant/{domain}", "App\Http\Controllers\Staff\TenantController@identifyDomain");

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get("/logout", "App\Http\Controllers\LoginController@logout")->name('logout');

    Route::apiResource('business-service-statuses', 'App\Http\Controllers\Staff\Business\BusinessServiceStatusController')->only(['index']);
    Route::get("businesses/{business}/services/activate/{service}", "App\Http\Controllers\Staff\Business\BusinessServicePriceController@activate")->name('businesses.services.activate');
    Route::get("businesses/{business}/services/suspend/{service}", "App\Http\Controllers\Staff\Business\BusinessServicePriceController@suspend")->name('businesses.services.suspend');
    Route::get("businesses/{business}/services/cancel/{service}", "App\Http\Controllers\Staff\Business\BusinessServicePriceController@cancel")->name('businesses.services.cancel');
    Route::apiResource('businesses.services', 'App\Http\Controllers\Staff\Business\BusinessServicePriceController')->only(['store', 'update', 'destroy']);
    Route::get("businesses/{business}/features/sync", "App\Http\Controllers\Staff\Business\BusinessFeatureController@sync")->name('businesses.features.sync');
    Route::put("businesses/{business}/features", "App\Http\Controllers\Staff\Business\BusinessFeatureController@update")->name('businesses.features.update');
    Route::get("businesses/activate/{business}", "App\Http\Controllers\Staff\Business\BusinessController@activate")->name('businesses.activate');
    Route::post("businesses/assign/{business}", "App\Http\Controllers\Staff\Business\BusinessController@assign")->name('businesses.assign');
    Route::apiResource('businesses', 'App\Http\Controllers\Staff\Business\BusinessController');

    Route::apiResource('features', 'App\Http\Controllers\Staff\Feature\FeatureController');

    Route::apiResource('ticket-departments', 'App\Http\Controllers\Staff\Ticket\TicketDepartmentController')->only(['index']);
    Route::apiResource('ticket-statuses', 'App\Http\Controllers\Staff\Ticket\TicketStatusController')->only(['index']);
    Route::apiResource('tickets.replies', 'App\Http\Controllers\Staff\Ticket\TicketReplyController')->only(['store', 'update', 'destroy']);
    Route::get("tickets/close/{ticket}", "App\Http\Controllers\Staff\Ticket\TicketController@close")->name('tickets.close');
    Route::apiResource('tickets', 'App\Http\Controllers\Staff\Ticket\TicketController');
    
    Route::apiResource('users', 'App\Http\Controllers\User\UserController');
    Route::apiResource('roles', 'App\Http\Controllers\User\RoleController')->only(['index']);
    Route::apiResource('permission-groups', 'App\Http\Controllers\User\PermissionGroupController')->only('index');
    Route::get('permissions-by-group', 'App\Http\Controllers\User\PermissionController@permissionsByGroup');
    Route::apiResource('permissions', 'App\Http\Controllers\User\PermissionController');

    Route::apiResource('billing-cycles', 'App\Http\Controllers\Staff\Service\BillingCycleController')->only(['index']);
    Route::apiResource('service-price-types', 'App\Http\Controllers\Staff\Service\ServicePriceTypeController');
    Route::apiResource('feature-groups', 'App\Http\Controllers\Staff\Feature\FeatureGroupController')->only(['index']);
    Route::apiResource('services.prices', 'App\Http\Controllers\Staff\Service\ServicePriceController')->only(['store', 'update', 'destroy']);
    Route::put("services/{service}/features", "App\Http\Controllers\Staff\Service\ServiceFeatureController@update")->name('services.features.update');
    Route::apiResource('services', 'App\Http\Controllers\Staff\Service\ServiceController');

    Route::apiResource('currencies', 'App\Http\Controllers\Staff\CurrencyController')->only(['index']);
    
    Route::apiResource('payment-methods', 'App\Http\Controllers\Staff\Bill\PaymentMethodController')->only(['index']);
    Route::apiResource('bill-statuses', 'App\Http\Controllers\Staff\Bill\BillStatusController')->only(['index']);
    Route::apiResource('bills.services', 'App\Http\Controllers\Staff\Bill\BillServiceController')->only(['store', 'update', 'destroy']);
    Route::get("bills/{bill}/payments/cancel/{payment}", "App\Http\Controllers\Staff\Bill\BillPaymentController@cancel")->name('bills.payments.cancel');
    Route::apiResource('bills.payments', 'App\Http\Controllers\Staff\Bill\BillPaymentController')->only(['store', 'update', 'destroy']);
    Route::get("bills/cancel/{bill}", "App\Http\Controllers\Staff\Bill\BillController@cancel")->name('bills.cancel');
    Route::apiResource('bills', 'App\Http\Controllers\Staff\Bill\BillController');

    Route::get('settings', 'App\Http\Controllers\Staff\SettingController@index');
    Route::put('settings', 'App\Http\Controllers\Staff\SettingController@update');

    Route::get("init", "App\Http\Controllers\InitController@init")->name('init');
});


