<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerBillingAddressRequest;
use App\Models\Customer\Customer;

class CustomerBillingAddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\CustomerBillingAddressRequest  $request
     * @param  int  $customerId
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerBillingAddressRequest $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->billingAddresses()->create($request->validated());
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\CustomerBillingAddressRequest  $request
     * @param  int  $customerId
     * @param  int  $customerBillingAddressId
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerBillingAddressRequest $request, $customerId, $customerBillingAddressId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->billingAddresses()->findOrFail($customerBillingAddressId)->update($request->validated());
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerId
     * @param  int  $customerBillingAddressId
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerId, $customerBillingAddressId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->billingAddresses()->findOrFail($customerBillingAddressId)->delete();
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }
}
