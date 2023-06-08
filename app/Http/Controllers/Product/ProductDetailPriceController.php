<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductDetailPriceRequest;
use App\Models\Product\Product;

class ProductDetailPriceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @return \Illuminate\Http\Response
     */
    public function store(ProductDetailPriceRequest $request, $productId, $productDetailId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->prices()->create($request->validated());

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @param  int  $productDetailPriceId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductDetailPriceRequest $request, $productId, $productDetailId, $productDetailPriceId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->prices()->findOrFail($productDetailPriceId)->update($request->validated());

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @param  int  $productDetailPriceId
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetailPriceRequest $request, $productId, $productDetailId, $productDetailPriceId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->prices()->findOrFail($productDetailPriceId)->delete();

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }
}
