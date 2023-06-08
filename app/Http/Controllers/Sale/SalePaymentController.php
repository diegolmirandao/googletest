<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SalePaymentRequest;
use App\Models\Sale\Sale;

class SalePaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Payment\SalePaymentRequest  $request
     * @param  int  $saleId
     * @return \Illuminate\Http\Response
     */
    public function store(SalePaymentRequest $request, $saleId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->payments()->create($request->validated());

        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);
        
        $sale->setPaidAmount();
        $sale->setPaidAt();
        $sale->save();

        return $sale;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Payment\SalePaymentRequest  $request
     * @param  int  $saleId
     * @param  int  $salePaymentId
     * @return \Illuminate\Http\Response
     */
    public function update(SalePaymentRequest $request, $saleId, $salePaymentId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->payments()->findOrFail($salePaymentId)->update($request->validated());

        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $sale->setPaidAmount();
        $sale->setPaidAt();
        $sale->save();

        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $saleId
     * @param  int  $salePaymentId
     * @return \Illuminate\Http\Response
     */
    public function destroy($saleId, $salePaymentId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->payments()->findOrFail($salePaymentId)->delete();
        
        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $sale->setPaidAmount();
        $sale->setPaidAt();
        $sale->save();

        return $sale;
    }
}
