<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductDetailRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->filled('page_size') ? $request->page_size : config('constants.default_page_size');
        $productDetails = ProductDetail::filter()->cursorPaginate($pageSize);
        return $productDetails;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function store(ProductDetailRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $productDetail = $product->details()->create($request->validated());
        $productDetail->codes()->createMany($request->validated()['codes'] ?? []);
        $productDetail->descriptions()->createMany($request->validated()['descriptions'] ?? []);

        $variantOptions = collect($request->validated()['variants'] ?? [])->map(fn($variant) => ['variant_option_id' => $variant['option_id']]);
        $productDetail->prices()->createMany($request->validated()['prices'] ?? []);
        $productDetail->variants()->createMany($variantOptions);
        
        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $productDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productId
     * @param  int  $productDetailId
     * @return \Illuminate\Http\Response
     */
    public function show($productId, $productDetailId)
    {
        $productDetail = ProductDetail::findOrFail($productDetailId);
        return $productDetail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductDetailRequest $request, $productId, $productDetailId)
    {
        $productDetail = ProductDetail::findOrFail($productDetailId);
        // $productDetail->update($request->safe()->except(['variants']));

        // $receivedVariants = collect($request->validated()['variants']);
        // $productDetail->variants()->each(function ($productDetailVariant) use ($receivedVariants) {
        //     $updatedVariant = $receivedVariants->filter(fn($receivedVariant) => $receivedVariant);
        //     $productDetailVariant->update();
        // });

        return $productDetail;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\Product\ProductDetailRequest  $request
     * @param  int  $productId
     * @param  int  $productDetailId
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetailRequest $request, $productId, $productDetailId)
    {
        $product = Product::findOrFail($productId);
        $product->details()->findOrFail($productDetailId)->delete();

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
        ;
    }
}
