<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierAddressRequest;
use App\Models\Supplier\Supplier;

class SupplierAddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\SupplierAddressRequest  $request
     * @param  int  $supplierId
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierAddressRequest $request, $supplierId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->addresses()->create($request->validated());
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\SupplierAddressRequest  $request
     * @param  int  $supplierId
     * @param  int  $supplierAddressId
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierAddressRequest $request, $supplierId, $supplierAddressId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->addresses()->findOrFail($supplierAddressId)->update($request->validated());
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $supplierId
     * @param  int  $supplierAddressId
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplierId, $supplierAddressId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->addresses()->findOrFail($supplierAddressId)->delete();
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }
}
