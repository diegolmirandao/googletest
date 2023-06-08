<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\SaleRequest;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
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
        $sales = Sale::filter()->cursorPaginate($pageSize);
        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        $sale = Sale::create($request->validated());
        $sale->products()->createMany($request->validated()['products']);
        $sale->payments()->createMany($request->validated()['payments']);
        $sale->instalments()->createMany($request->validated()['instalments']);

        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $sale->setAmount();
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
        $sale = Sale::findOrFail($saleId);
        
        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);
        return $sale;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SaleRequest  $request
     * @param  int  $saleId
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $saleId)
    {
        $products = array_map(fn($product) => array_merge($product, ['sale_id' => $saleId]), $request->validated()['products']);
        $payments = array_map(fn($payment) => array_merge($payment, ['sale_id' => $saleId]), $request->validated()['payments']);
        $instalments = array_map(fn($instalment) => array_merge($instalment, ['sale_id' => $saleId]), $request->validated()['instalments']);

        $sale = Sale::findOrFail($saleId);
        $sale->update($request->validated());
        $sale->products()->upsert($products, 'id');
        $sale->payments()->upsert($payments, 'id');
        $sale->instalments()->upsert($instalments, 'id');

        $sale->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'documentType', 'paymentTerm', 'products', 'payments', 'instalments']);

        $sale->setAmount();
        $sale->setPaidAmount();
        $sale->setPaidAt();
        $sale->save();

        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $saleId
     * @return \Illuminate\Http\Response
     */
    public function destroy($saleId)
    {
        $sale = Sale::findOrFail($saleId);
        $sale->delete();

        return $sale;
    }
}
