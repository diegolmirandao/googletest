<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\PropertyRequest;
use App\Models\Product\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();

        return $properties;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\PropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $property = Property::create($request->validated());
        $property->subcategories()->sync($request->validated()['subcategories'] ?? []);
        $property->options()->createMany($request->validated()['options'] ?? []);
        $property->load(['measurementUnit', 'subcategories', 'options']);

        return $property;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $propertyId
     * @return \Illuminate\Http\Response
     */
    public function show($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $property->load(['measurementUnit', 'subcategories', 'options']);
        return $property;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\PropertyRequest  $request
     * @param  int  $propertyId
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $property->update($request->validated());
        $property->subcategories()->sync($request->validated()['subcategories'] ?? []);
        $property->load(['measurementUnit', 'subcategories', 'options']);

        return $property;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $propertyId
     * @return \Illuminate\Http\Response
     */
    public function destroy($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $property->delete();

        return $property;
    }
}
