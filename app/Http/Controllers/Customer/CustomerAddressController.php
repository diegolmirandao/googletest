<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerAddressRequest;
use App\Models\Customer\Customer;

class CustomerAddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\CustomerAddressRequest  $request
     * @param  int  $customerId
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerAddressRequest $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->addresses()->create($request->validated());
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\CustomerAddressRequest  $request
     * @param  int  $customerId
     * @param  int  $customerAddressId
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerAddressRequest $request, $customerId, $customerAddressId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->addresses()->findOrFail($customerAddressId)->update($request->validated());
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $customerId
     * @param  int  $customerAddressId
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerId, $customerAddressId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->addresses()->findOrFail($customerAddressId)->delete();
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }
}
