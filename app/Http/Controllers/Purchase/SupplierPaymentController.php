<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchasePaymentRequest;
use App\Models\Purchase\Purchase;
use App\Models\Purchase\PurchasePayment;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
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
        $purchases = PurchasePayment::filter()->cursorPaginate($pageSize);
        return $purchases;
    }

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
     * Display the specified resource.
     *
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function show($purchaseId)
    {
        $purchasePayment = PurchasePayment::findOrFail($purchaseId);
        
        return $purchasePayment;
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
