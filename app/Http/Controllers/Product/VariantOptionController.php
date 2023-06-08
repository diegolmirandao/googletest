<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\VariantOptionRequest;
use App\Models\Product\Variant;
use App\Models\Product\VariantOption;
use Illuminate\Http\Request;

class VariantOptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\VariantOptionRequest  $request
     * @param  int  $variantId
     * @return \Illuminate\Http\Response
     */
    public function store(VariantOptionRequest $request, $variantId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->options()->create($request->validated());
        $variant->load('options');

        return $variant;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\VariantOptionRequest  $request
     * @param  int  $variantId
     * @param  int  $variantOptionId
     * @return \Illuminate\Http\Response
     */
    public function update(VariantOptionRequest $request, $variantId, $variantOptionId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->options()->findOrFail($variantOptionId)->update($request->validated());
        $variant->load('options');

        return $variant;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $variantId
     * @param  int  $variantOptionId
     * @return \Illuminate\Http\Response
     */
    public function destroy($variantId, $variantOptionId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->options()->findOrFail($variantOptionId)->delete();
        $variant->load('options');

        return $variant;
    }
}
