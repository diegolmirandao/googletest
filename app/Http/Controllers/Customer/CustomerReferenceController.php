<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerReferenceRequest;
use App\Models\Customer\Customer;

class CustomerReferenceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\CustomerReferenceRequest  $request
     * @param  int  $customerId
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerReferenceRequest $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->references()->create($request->validated());
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\CustomerReferenceRequest  $request
     * @param  int  $customerId
     * @param  int  $customerReferenceId
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerReferenceRequest $request, $customerId, $customerReferenceId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->references()->findOrFail($customerReferenceId)->update($request->validated());
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerId
     * @param  int  $customerReferenceId
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerId, $customerReferenceId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->references()->findOrFail($customerReferenceId)->delete();
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }
}
