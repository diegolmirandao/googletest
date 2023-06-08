<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierContactRequest;
use App\Models\Supplier\Supplier;

class SupplierContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\SupplierContactRequest  $request
     * @param  int  $supplierId
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierContactRequest $request, $supplierId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->contacts()->create($request->validated());
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\SupplierContactRequest  $request
     * @param  int  $supplierId
     * @param  int  $supplierContactId
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierContactRequest $request, $supplierId, $supplierContactId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->contacts()->findOrFail($supplierContactId)->update($request->validated());
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $supplierId
     * @param  int  $supplierContactId
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplierId, $supplierContactId)
    {
        $supplier = Supplier::findOrFail($supplierId);
        $supplier->contacts()->findOrFail($supplierContactId)->delete();
        $supplier->load(['contacts', 'addresses']);

        return $supplier;
    }
}
