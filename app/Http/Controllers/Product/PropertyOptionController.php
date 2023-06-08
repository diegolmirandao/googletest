<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\PropertyOptionRequest;
use App\Models\Product\Property;

class PropertyOptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\PropertyOptionRequest  $request
     * @param  int  $propertyId
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyOptionRequest $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $property->options()->create($request->validated());
        $property->load('options');

        return $property;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\PropertyOptionRequest  $request
     * @param  int  $propertyId
     * @param  int  $propertyOptionId
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyOptionRequest $request, $propertyId, $propertyOptionId)
    {
        $property = Property::findOrFail($propertyId);
        $property->options()->findOrFail($propertyOptionId)->update($request->validated());
        $property->load('options');

        return $property;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $propertyId
     * @param  int  $propertyOptionId
     * @return \Illuminate\Http\Response
     */
    public function destroy($propertyId, $propertyOptionId)
    {
        $property = Property::findOrFail($propertyId);
        $property->options()->findOrFail($propertyOptionId)->delete();
        $property->load('options');

        return $property;
    }
}
