<?php

namespace App\Http\Controllers\Staff\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Business\BusinessServicePriceRequest;
use App\Models\Staff\Business\Business;
use App\Models\Staff\Business\BusinessServicePrice;
use App\Events\Staff\BusinessServicePrice\BusinessServicePriceActivated;
use App\Events\Staff\BusinessServicePrice\BusinessServicePriceSuspended;
use App\Events\Staff\BusinessServicePrice\BusinessServicePriceCanceled;

class BusinessServicePriceController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:business_service.view'])->only('show');
        $this->middleware(['direct_permission:business_service.create'])->only('store');
        $this->middleware(['direct_permission:business_service.update'])->only('update');
        $this->middleware(['direct_permission:business_service.delete'])->only('destroy');
        $this->middleware(['direct_permission:business_service.activate'])->only('activate');
        $this->middleware(['direct_permission:business_service.suspend'])->only('suspend');
        $this->middleware(['direct_permission:business_service.cancel'])->only('cancel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BusinessServicePriceRequest  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessServicePriceRequest $request, Business $business)
    {
        $business->services()->create($request->safe()->except('service_price', 'service'));
        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business, BusinessServicePrice $service)
    {
        $service->load('business', 'status');

        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BusinessServicePriceRequest  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $service
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessServicePriceRequest $request, Business $business, BusinessServicePrice $service)
    {
        $service->update($request->validated());
        $business->load(['services', 'features']);
        
        return $business;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business, BusinessServicePrice $service)
    {
        $service->delete();
        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Activate the service to the business.
     *
     * @param  \App\Http\Requests\BusinessServicePriceRequest  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function activate(BusinessServicePriceRequest $request, Business $business, BusinessServicePrice $service)
    {
        $service->update([
            'business_service_status_id' => 2,
            'activated_at' => now()
        ]);

        BusinessServicePriceActivated::dispatch($service);

        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Suspend the service to the business.
     *
     * @param  \App\Http\Requests\BusinessServicePriceRequest  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function suspend(BusinessServicePriceRequest $request, Business $business, BusinessServicePrice $service)
    {
        $service->update([
            'business_service_status_id' => 3,
            'suspended_at' => now()
        ]);

        BusinessServicePriceSuspended::dispatch($service);

        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Cancel the service to the business.
     *
     * @param  \App\Http\Requests\BusinessServicePriceRequest  $request
     * @param  \App\Models\Business  $business
     * @param  \App\Models\BusinessServicePrice  $servicePrice
     * @return \Illuminate\Http\Response
     */
    public function cancel(BusinessServicePriceRequest $request, Business $business, BusinessServicePrice $service)
    {
        $service->update([
            'business_service_status_id' => 4,
            'canceled_at' => now()
        ]);

        BusinessServicePriceCanceled::dispatch($service);

        $business->load(['services', 'features']);

        return $business;
    }
}
