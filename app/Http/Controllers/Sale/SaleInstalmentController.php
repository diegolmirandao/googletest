<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SaleInstalmentRequest;
use App\Models\Sale\Sale;

class SaleInstalmentController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Instalment\SaleInstalmentRequest  $request
     * @param  int  $saleId
     * @return \Illuminate\Http\Response
     */
    public function update(SaleInstalmentRequest $request, $saleId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->instalments()->delete();
        $sale->instalments()->createMany($request->validated());
        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        return $sale;
    }
}
