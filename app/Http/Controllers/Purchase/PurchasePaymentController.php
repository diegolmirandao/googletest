<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchasePaymentRequest;
use App\Models\Purchase\Purchase;

class PurchasePaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Payment\PurchasePaymentRequest  $request
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function store(PurchasePaymentRequest $request, $purchaseId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->payments()->create($request->validated());

        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);
        
        $purchase->setPaidAmount();
        $purchase->setPaidAt();
        $purchase->save();

        return $purchase;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Payment\PurchasePaymentRequest  $request
     * @param  int  $purchaseId
     * @param  int  $purchasePaymentId
     * @return \Illuminate\Http\Response
     */
    public function update(PurchasePaymentRequest $request, $purchaseId, $purchasePaymentId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->payments()->findOrFail($purchasePaymentId)->update($request->validated());

        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $purchase->setPaidAmount();
        $purchase->setPaidAt();
        $purchase->save();

        return $purchase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $purchaseId
     * @param  int  $purchasePaymentId
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchaseId, $purchasePaymentId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->payments()->findOrFail($purchasePaymentId)->delete();
        
        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $purchase->setPaidAmount();
        $purchase->setPaidAt();
        $purchase->save();

        return $purchase;
    }
}
