<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseInstalmentRequest;
use App\Models\Purchase\Purchase;

class PurchaseInstalmentController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Instalment\PurchaseInstalmentRequest  $request
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseInstalmentRequest $request, $purchaseId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->instalments()->delete();
        $purchase->instalments()->createMany($request->validated());
        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $purchase;
    }
}
