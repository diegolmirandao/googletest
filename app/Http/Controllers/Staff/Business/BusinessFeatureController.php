<?php

namespace App\Http\Controllers\Staff\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Business\BusinessFeatureRequest;
use App\Models\Staff\BusinessFeature;
use App\Models\Staff\Business\Business;

class BusinessFeatureController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:business_feature.update'])->only('update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BusinessFeatureRequest  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessFeatureRequest $request, Business $business)
    {
        $business->syncFeatures($request->validated());
        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Sync all active services features to business features.
     *
     * @param  \App\Http\Requests\BusinessFeatureRequest  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function sync(BusinessFeatureRequest $request, Business $business)
    {
        $business->syncFeaturesToService();

        return $business;
    }
}
