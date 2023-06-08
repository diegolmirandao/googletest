<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierRequest;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;
use App\Events\SupplierBroadcastEvent;
use App\Models\Device;

class SupplierController extends Controller
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
        $suppliers = Supplier::filter()->cursorPaginate($pageSize);

        return $suppliers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        $supplier->phones()->createMany(!!$request->validated()['phones'] ? array_map(fn($phone) => ['phone' => $phone], $request->validated()['phones']) : []);
        $supplier->contacts()->createMany(!!$request->validated()['contacts'] ? $request->validated()['contacts'] : []);
        $supplier->addresses()->createMany(!!$request->validated()['addresses'] ? $request->validated()['addresses'] : []);
        $supplier->load(['contacts', 'addresses']);

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        SupplierBroadcastEvent::dispatch($supplier, 'created', $devices);

        return $supplier;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $supplierId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $supplierId)
    {
        $supplier = Supplier::findOrFail($supplierId);

        $supplier->setSynced($request->cookie('Device-Id'));
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @param  int  $supplierId
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $supplierId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->update($request->validated());
        
        //add and delete phones
        $receivedPhones = collect($request->validated()['phones']);
        $newPhones = $receivedPhones->map(fn($phone) => ['phone' => $phone])->whereNotIn('phone', $supplier->phones);
        $supplier->phones()->createMany($newPhones);
        $supplier->phones()->whereNotIn('phone', $receivedPhones->all())->delete();

        $supplier->load(['contacts', 'addresses']);

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        SupplierBroadcastEvent::dispatch($supplier, 'updated', $devices);

        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @param  int  $supplierId
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierRequest $request, $supplierId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->delete();
        
        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        SupplierBroadcastEvent::dispatch($supplier, 'deleted', $devices);

        return $supplier;
    }
}
