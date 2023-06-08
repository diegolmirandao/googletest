<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\VariantRequest;
use App\Models\Product\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variants = Variant::all();

        return $variants;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\VariantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VariantRequest $request)
    {
        $variant = Variant::create($request->validated());
        $variant->options()->createMany($request->validated()['options']);
        $variant->subcategories()->sync($request->validated()['subcategories'] ?? []);
        $variant->load(['subcategories', 'options']);

        return $variant;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $variantId
     * @return \Illuminate\Http\Response
     */
    public function show($variantId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->load(['subcategories', 'options']);
        return $variant;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\VariantRequest  $request
     * @param  int  $variantId
     * @return \Illuminate\Http\Response
     */
    public function update(VariantRequest $request, $variantId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->update($request->validated());
        $variant->subcategories()->sync($request->validated()['subcategories'] ?? []);
        $variant->load(['subcategories', 'options']);

        return $variant;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $variantId
     * @return \Illuminate\Http\Response
     */
    public function destroy($variantId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->delete();

        return $variant;
    }
}
