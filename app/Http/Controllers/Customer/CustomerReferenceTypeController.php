<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerReferenceTypeRequest;
use App\Models\Customer\CustomerReferenceType;

class CustomerReferenceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerReferenceType = CustomerReferenceType::all();

        return $customerReferenceType;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerReferenceTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerReferenceTypeRequest $request)
    {
        $customerReferenceType = CustomerReferenceType::create($request->validated());

        return $customerReferenceType;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customerReferenceTypeId
     * @return \Illuminate\Http\Response
     */
    public function show($customerReferenceTypeId)
    {
        $customerReferenceType = CustomerReferenceType::findOrFail($customerReferenceTypeId);
        return $customerReferenceType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerReferenceTypeRequest  $request
     * @param  int  $customerReferenceTypeId
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerReferenceTypeRequest $request, $customerReferenceTypeId)
    {
        $customerReferenceType = CustomerReferenceType::findOrFail($customerReferenceTypeId);
        $customerReferenceType->update($request->validated());

        return $customerReferenceType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerReferenceTypeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerReferenceTypeId)
    {
        $customerReferenceType = CustomerReferenceType::findOrFail($customerReferenceTypeId);
        $customerReferenceType->delete();

        return $customerReferenceType;
    }
}
