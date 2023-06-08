<?php

namespace App\Http\Controllers\Staff\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Service\ServiceFeatureRequest;
use App\Models\Staff\Service\Service;
use App\Models\Staff\ServiceFeature;

class ServiceFeatureController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:service_feature.update'])->only('update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServiceFeatureRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceFeatureRequest $request, Service $service)
    {
        $service->syncFeatures($request->validated());
        $service->load(['prices', 'features']);

        return $service;
    }
}
