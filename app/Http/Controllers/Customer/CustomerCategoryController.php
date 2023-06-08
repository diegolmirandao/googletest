<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerCategoryRequest;
use App\Models\Customer\CustomerCategory;

class CustomerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerCategories = CustomerCategory::all();

        return $customerCategories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerCategoryRequest $request)
    {
        $customerCategory = CustomerCategory::create($request->validated());

        return $customerCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customerCategoryId
     * @return \Illuminate\Http\Response
     */
    public function show($customerCategoryId)
    {
        $customerCategory = CustomerCategory::findOrFail($customerCategoryId);
        return $customerCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerCategoryRequest  $request
     * @param  int  $customerCategoryId
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerCategoryRequest $request, $customerCategoryId)
    {
        $customerCategory = CustomerCategory::findOrFail($customerCategoryId);
        $customerCategory->update($request->validated());

        return $customerCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerCategoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerCategoryId)
    {
        $customerCategory = CustomerCategory::findOrFail($customerCategoryId);
        $customerCategory->delete();

        return $customerCategory;
    }
}
