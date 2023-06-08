<?php

namespace App\Http\Controllers\Staff\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Service\ServicePriceRequest;
use App\Models\Staff\Service\Service;
use App\Models\Staff\Service\ServicePrice;

class ServicePriceController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:service_price.create'])->only('store');
        $this->middleware(['direct_permission:service_price.update'])->only('update');
        $this->middleware(['direct_permission:service_price.delete'])->only('destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServicePriceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function store(ServicePriceRequest $request, Service $service)
    {
        $service->prices()->create($request->validated());
        $service->load(['prices', 'features']);

        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServicePriceRequest  $request
     * @param  \App\Models\Service  $service
     * @param  \App\Models\ServicePrice  $price
     * @return \Illuminate\Http\Response
     */
    public function update(ServicePriceRequest $request, Service $service, ServicePrice $price)
    {
        $service->prices()->findOrFail($price->id)->update($request->validated());
        $service->load(['prices', 'features']);

        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @param  \App\Models\ServicePrice  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePriceRequest $request, Service $service, ServicePrice $price)
    {
        $service->prices()->findOrFail($price->id)->delete();
        $service->load(['prices', 'features']);

        return $service;
    }
}
