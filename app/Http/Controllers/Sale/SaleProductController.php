<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SaleProductRequest;
use App\Models\Sale\Sale;

class SaleProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\SaleProductRequest  $request
     * @param  int  $saleId
     * @return \Illuminate\Http\Response
     */
    public function store(SaleProductRequest $request, $saleId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->products()->create($request->validated());

        $sale->setAmount();
        $sale->setPaidAt();
        $sale->save();

        $sale->load(['customer', 'currency', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $sale;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\SaleProductRequest  $request
     * @param  int  $saleId
     * @param  int  $saleProductId
     * @return \Illuminate\Http\Response
     */
    public function update(SaleProductRequest $request, $saleId, $saleProductId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->products()->findOrFail($saleProductId)->update($request->validated());

        $sale->setAmount();
        $sale->setPaidAt();
        $sale->save();

        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $saleId
     * @param  int  $saleProductId
     * @return \Illuminate\Http\Response
     */
    public function destroy($saleId, $saleProductId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->products()->findOrFail($saleProductId)->delete();

        $sale->setAmount();
        $sale->setPaidAt();
        $sale->save();
        
        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $sale;
    }
}
