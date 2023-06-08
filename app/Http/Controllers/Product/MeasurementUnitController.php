<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\MeasurementUnitRequest;
use App\Models\Product\MeasurementUnit;
use Illuminate\Http\Request;

class MeasurementUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurementUnits = MeasurementUnit::all();

        return $measurementUnits;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\MeasurementUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeasurementUnitRequest $request)
    {
        $measurementUnit = MeasurementUnit::create($request->validated());

        return $measurementUnit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $measurementUnitId
     * @return \Illuminate\Http\Response
     */
    public function show($measurementUnitId)
    {
        $measurementUnit = MeasurementUnit::findOrFail($measurementUnitId);
        return $measurementUnit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\MeasurementUnitRequest  $request
     * @param  int  $measurementUnitId
     * @return \Illuminate\Http\Response
     */
    public function update(MeasurementUnitRequest $request, $measurementUnitId)
    {
        $measurementUnit = MeasurementUnit::findOrFail($measurementUnitId);
        $measurementUnit->update($request->validated());

        return $measurementUnit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $measurementUnitId
     * @return \Illuminate\Http\Response
     */
    public function destroy($measurementUnitId)
    {
        $measurementUnit = MeasurementUnit::findOrFail($measurementUnitId);
        $measurementUnit->delete();

        return $measurementUnit;
    }
}
