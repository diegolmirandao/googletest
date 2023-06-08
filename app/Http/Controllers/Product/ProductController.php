<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
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
        $products = Product::with('details')->filter()->cursorPaginate($pageSize);
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $codes = !!$request->validated()['codes'] ? array_map(fn($code) => ['code' => $code], $request->validated()['codes']) : [];
        $properties = !!$request->validated()['properties'] ? array_merge(...array_map(function ($property){
            if (is_array($property['value'])) {
                return array_map(fn($value) => [
                    'property_id' => $property['property_id'],
                    'property_option_id' => $value
                ], $property['value']);
            }
            return [$property];
        }, $request->validated()['properties'])) : [];

        $product = Product::create($request->validated());
        $product->codes()->createMany($codes);
        // $product->descriptions()->createMany(!!$request->validated()['descriptions'] ? $request->validated()['descriptions'] : []);
        // $product->parameters()->createMany($request->validated()['parameters'] ?? []);
        $product->properties()->createMany($properties);
        $productDetails = $product->details()->createMany(!!$request->validated()['details'] ? $request->validated()['details'] : [[
            'status' => 1,
        ]]);

        $receivedDetails = count($request->validated()['details']) > 0 ? $request->validated()['details'] : [[
            'codes' => [],
            'costs' => $request->validated()['costs'],
            'prices' => $request->validated()['prices'],
            'variants' => []
        ]];
        $productDetails->each(function ($productDetail, $index) use($receivedDetails) {
            $variantOptions = collect(!!$receivedDetails[$index]['variants'] ? $receivedDetails[$index]['variants'] : [])->map(fn($variant) => ['variant_option_id' => $variant['option_id']]);
            $productDetail->codes()->createMany(!!$receivedDetails[$index]['codes'] ? array_map(fn($code) => ['code' => $code], $receivedDetails[$index]['codes']) : []);
            $productDetail->costs()->createMany(!!$receivedDetails[$index]['costs'] ? $receivedDetails[$index]['costs'] : []);
            $productDetail->prices()->createMany(!!$receivedDetails[$index]['prices'] ? $receivedDetails[$index]['prices'] : []);
            $productDetail->variants()->createMany($variantOptions);
        });

        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest  $request
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->update($request->validated());

        //add codes
        // $receivedCodes = collect($request->validated()['codes']);
        // $product->codes->each(function ($code) use ($receivedCodes) {
        //     if ($receivedCodes->contains('id', $code->id)) {
        //         $updatedCode = $receivedCodes->firstWhere('id', $code->id);
        //         $code->update(['code' => $updatedCode]);
        //     } else {
        //         $code->delete();
        //     }
        // });
        // $newCodes = $receivedCodes->whereNull('id');
        // $product->codes()->createMany($newCodes);

        //add descriptions
        // $receivedDescriptions = collect($request->validated()['descriptions']);
        // $product->descriptions->each(function ($description) use ($receivedDescriptions) {
        //     if ($receivedDescriptions->contains('id', $description->id)) {
        //         $updatedDescriptionName = $receivedDescriptions->firstWhere('id', $description->id)['name'];
        //         $updatedDescription = $receivedDescriptions->firstWhere('id', $description->id)['description'];
        //         $description->update(['name' => $updatedDescriptionName, 'description' => $updatedDescription]);
        //     } else {
        //         $description->delete();
        //     }
        // });
        // $newDescriptions = $receivedDescriptions->whereNull('id');
        // $product->descriptions()->createMany($newDescriptions);
        
        $product->load(['category', 'subcategory', 'brand', 'type', 'measurementUnit', 'descriptions', 'details', 'images', 'parameters']);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return $product;
    }
}
