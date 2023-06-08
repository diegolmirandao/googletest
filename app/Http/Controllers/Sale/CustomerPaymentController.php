<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SalePaymentRequest;
use App\Models\Sale\Sale;
use App\Models\Sale\SalePayment;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
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
        $sales = SalePayment::filter()->cursorPaginate($pageSize);
        return $sales;
    }

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
     * Display the specified resource.
     *
     * @param  int  $saleId
     * @return \Illuminate\Http\Response
     */
    public function show($saleId)
    {
        $salePayment = SalePayment::findOrFail($saleId);
        
        return $salePayment;
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
