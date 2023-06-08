<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductPriceTypeRequest;
use App\Models\Product\ProductPriceType;

class ProductPriceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productPriceTypes = ProductPriceType::all();

        return $productPriceTypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductPriceTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPriceTypeRequest $request)
    {
        $productPriceType = ProductPriceType::create($request->validated());

        return $productPriceType;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productPriceTypeId
     * @return \Illuminate\Http\Response
     */
    public function show($productPriceTypeId)
    {
        $productPriceType = ProductPriceType::findOrFail($productPriceTypeId);
        return $productPriceType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductPriceTypeRequest  $request
     * @param  int  $productPriceTypeId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPriceTypeRequest $request, $productPriceTypeId)
    {
        $productPriceType = ProductPriceType::findOrFail($productPriceTypeId);
        $productPriceType->update($request->validated());

        return $productPriceType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productPriceTypeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($productPriceTypeId)
    {
        $productPriceType = ProductPriceType::findOrFail($productPriceTypeId);
        $productPriceType->delete();

        return $productPriceType;
    }
}
