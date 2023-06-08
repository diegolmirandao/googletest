<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseRequest;
use App\Models\Purchase\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
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
        $purchases = Purchase::filter()->cursorPaginate($pageSize);
        return $purchases;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $purchase = Purchase::create($request->validated());
        $purchase->products()->createMany($request->validated()['products']);
        $purchase->payments()->createMany($request->validated()['payments']);
        $purchase->instalments()->createMany($request->validated()['instalments']);

        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $purchase->setAmount();
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
        $purchase = Purchase::findOrFail($purchaseId);
        
        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);
        return $purchase;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PurchaseRequest  $request
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $purchaseId)
    {
        $products = array_map(fn($product) => array_merge($product, ['purchase_id' => $purchaseId]), $request->validated()['products']);
        $payments = array_map(fn($payment) => array_merge($payment, ['purchase_id' => $purchaseId]), $request->validated()['payments']);
        $instalments = array_map(fn($instalment) => array_merge($instalment, ['purchase_id' => $purchaseId]), $request->validated()['instalments']);

        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->update($request->validated());
        $purchase->products()->upsert($products, 'id');
        $purchase->payments()->upsert($payments, 'id');
        $purchase->instalments()->upsert($instalments, 'id');

        $purchase->load(['supplier', 'currency', 'establishment', 'warehouse', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $purchase->setAmount();
        $purchase->setPaidAmount();
        $purchase->setPaidAt();
        $purchase->save();

        return $purchase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function destroy($purchaseId)
    {
        $purchase = Purchase::findOrFail($purchaseId);
        $purchase->delete();

        return $purchase;
    }
}
