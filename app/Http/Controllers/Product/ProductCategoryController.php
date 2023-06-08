<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCategoryRequest;
use App\Models\Product\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::all();

        return $productCategories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create($request->validated());
        $productCategory->subcategories()->createMany($request->validated()['subcategories']);
        $productCategory->load('subcategories');

        return $productCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $productCategoryId
     * @return \Illuminate\Http\Response
     */
    public function show($productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        $productCategory->load('subcategories');
        return $productCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductCategoryRequest  $request
     * @param  int  $productCategoryId
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        $productCategory->update($request->validated());
        $productCategory->load('subcategories');

        return $productCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $productCategoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        $productCategory->delete();

        return $productCategory;
    }
}
