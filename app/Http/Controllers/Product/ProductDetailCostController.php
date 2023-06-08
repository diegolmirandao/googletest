<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductDetailCostRequest;
use App\Models\Product\Product;

class ProductDetailCostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @return \Illuminate\Http\Response
     */
    public function store(ProductDetailCostRequest $request, $productId, $productDetailId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->costs()->create($request->validated());

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @param  int  $productDetailCostId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductDetailCostRequest $request, $productId, $productDetailId, $productDetailCostId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->costs()->findOrFail($productDetailCostId)->update($request->validated());

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @param  int  $productDetailCostId
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetailCostRequest $request, $productId, $productDetailId, $productDetailCostId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->costs()->findOrFail($productDetailCostId)->delete();

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }
}
