<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointOfSaleRequest;
use App\Models\Establishment;

class PointOfSaleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\PointOfSaleRequest  $request
     * @param  int  $establishmentId
     * @return \Illuminate\Http\Response
     */
    public function store(PointOfSaleRequest $request, $establishmentId)
    {
        $establishment = Establishment::findOrFail($establishmentId);
        $establishment->pointsOfSale()->create($request->validated());
        $establishment->load('pointsOfSale');

        return $establishment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\PointOfSaleRequest  $request
     * @param  int  $establishmentId
     * @param  int  $pointOfSaleId
     * @return \Illuminate\Http\Response
     */
    public function update(PointOfSaleRequest $request, $establishmentId, $pointOfSaleId)
    {
        $establishment = Establishment::findOrFail($establishmentId);
        $establishment->pointsOfSale()->findOrFail($pointOfSaleId)->update($request->validated());
        $establishment->load('pointsOfSale');

        return $establishment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $establishmentId
     * @param  int  $pointOfSaleId
     * @return \Illuminate\Http\Response
     */
    public function destroy($establishmentId, $pointOfSaleId)
    {
        $establishment = Establishment::findOrFail($establishmentId);
        $establishment->pointsOfSale()->findOrFail($pointOfSaleId)->delete();
        $establishment->load('pointsOfSale');

        return $establishment;
    }
}
