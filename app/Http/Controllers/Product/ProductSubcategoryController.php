<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductSubcategoryRequest;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductSubcategory;

class ProductSubcategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductSubcategoryRequest  $request
     * @param  int  $productCategoryId
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSubcategoryRequest $request, $productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        $productCategory->subcategories()->create($request->validated());
        $productCategory->load('subcategories');

        return $productCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductSubcategoryRequest  $request
     * @param  int  $productCategoryId
     * @param  int  $productSubcategoryId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductSubcategoryRequest $request, $productCategoryId, $productSubcategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        $productCategory->subcategories()->findOrFail($productSubcategoryId)->update($request->validated());
        $productCategory->load('subcategories');

        return $productCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productCategoryId
     * @param  int  $productSubcategoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCategoryId, $productSubcategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        $productCategory->subcategories()->findOrFail($productSubcategoryId)->delete();
        $productCategory->load('subcategories');

        return $productCategory;
    }
}
