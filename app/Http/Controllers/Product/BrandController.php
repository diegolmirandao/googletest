<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\BrandRequest;
use App\Models\Product\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return $brands;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\BrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = Brand::create($request->validated());

        return $brand;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $brandId
     * @return \Illuminate\Http\Response
     */
    public function show($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        return $brand;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\BrandRequest  $request
     * @param  int  $brandId
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $brand->update($request->validated());

        return $brand;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $brandId
     * @return \Illuminate\Http\Response
     */
    public function destroy($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $brand->delete();

        return $brand;
    }
}
