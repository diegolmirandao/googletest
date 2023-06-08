<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCostTypeRequest;
use App\Models\Product\ProductCostType;

class ProductCostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCostTypes = ProductCostType::all();

        return $productCostTypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductCostTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCostTypeRequest $request)
    {
        $productCostType = ProductCostType::create($request->validated());

        return $productCostType;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productCostTypeId
     * @return \Illuminate\Http\Response
     */
    public function show($productCostTypeId)
    {
        $productCostType = ProductCostType::findOrFail($productCostTypeId);
        return $productCostType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductCostTypeRequest  $request
     * @param  int  $productCostTypeId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCostTypeRequest $request, $productCostTypeId)
    {
        $productCostType = ProductCostType::findOrFail($productCostTypeId);
        $productCostType->update($request->validated());

        return $productCostType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productCostTypeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCostTypeId)
    {
        $productCostType = ProductCostType::findOrFail($productCostTypeId);
        $productCostType->delete();

        return $productCostType;
    }
}
