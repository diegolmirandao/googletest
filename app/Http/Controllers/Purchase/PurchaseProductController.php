<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseProductRequest;
use App\Models\Purchase\Purchase;

class PurchaseProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\PurchaseProductRequest  $request
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseProductRequest $request, $purchaseId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->products()->create($request->validated());

        $purchase->setAmount();
        $purchase->setPaidAt();
        $purchase->save();

        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $purchase;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\PurchaseProductRequest  $request
     * @param  int  $purchaseId
     * @param  int  $purchaseProductId
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseProductRequest $request, $purchaseId, $purchaseProductId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->products()->findOrFail($purchaseProductId)->update($request->validated());

        $purchase->setAmount();
        $purchase->setPaidAt();
        $purchase->save();

        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $purchase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $purchaseId
     * @param  int  $purchaseProductId
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchaseId, $purchaseProductId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->products()->findOrFail($purchaseProductId)->delete();

        $purchase->setAmount();
        $purchase->setPaidAt();
        $purchase->save();
        
        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $purchase;
    }
}
