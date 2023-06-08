<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use App\Events\CustomerBroadcastEvent;
use App\Models\Device;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->filled('page_size') ? $request->page_size : config('constants.default_page_size');
        $customers = Customer::filter()->cursorPaginate($pageSize);

        return $customers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        $customer->phones()->createMany(!!$request->validated()['phones'] ? array_map(fn($phone) => ['phone' => $phone], $request->validated()['phones']) : []);
        $customer->billingAddresses()->createMany(!!$request->validated()['billing_addresses'] ? $request->validated()['billing_addresses'] : []);
        $customer->references()->createMany(!!$request->validated()['references'] ? $request->validated()['references'] : []);
        $customer->addresses()->createMany(!!$request->validated()['addresses'] ? $request->validated()['addresses'] : []);
        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        CustomerBroadcastEvent::dispatch($customer, 'created', $devices);

        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customerId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);

        $customer->setSynced($request->cookie('Device-Id'));
        $customer->load(['category', 'acquisitionChannel', 'phones', 'billingAddresses', 'references', 'addresses']);

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  int  $customerId
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->update($request->validated());
        
        //add and delete phones
        $receivedPhones = collect($request->validated()['phones']);
        $newPhones = $receivedPhones->map(fn($phone) => ['phone' => $phone])->whereNotIn('phone', $customer->phones);
        $customer->phones()->createMany($newPhones);
        $customer->phones()->whereNotIn('phone', $receivedPhones->all())->delete();

        $customer->load(['category', 'acquisitionChannel', 'billingAddresses', 'references', 'addresses']);

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        CustomerBroadcastEvent::dispatch($customer, 'updated', $devices);

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  int  $customerId
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerRequest $request, $customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $customer->delete();
        
        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        CustomerBroadcastEvent::dispatch($customer, 'deleted', $devices);

        return $customer;
    }
}
