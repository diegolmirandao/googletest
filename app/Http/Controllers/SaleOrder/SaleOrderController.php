<?php

namespace App\Http\Controllers\SaleOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleOrder\SaleOrderRequest;
use App\Models\SaleOrder\SaleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleOrderController extends Controller
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
        $saleOrders = SaleOrder::filter()->cursorPaginate($pageSize);
        return $saleOrders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaleOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleOrderRequest $request)
    {
        $saleOrder = SaleOrder::create($request->validated());
        $saleOrder->products()->createMany($request->validated()['products']);

        $saleOrder->refresh()->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'status', 'products']);

        $saleOrder->setAmount();
        $saleOrder->setStatus();
        $saleOrder->save();
        
        return $saleOrder;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $saleOrderId
     * @return \Illuminate\Http\Response
     */
    public function show($saleOrderId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        
        $saleOrder->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'status', 'products']);
        return $saleOrder;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SaleOrderRequest  $request
     * @param  int  $saleOrderId
     * @return \Illuminate\Http\Response
     */
    public function update(SaleOrderRequest $request, $saleOrderId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->update($request->validated());

        $saleOrder->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'status', 'products']);

        $saleOrder->setAmount();
        $saleOrder->setStatus();
        $saleOrder->save();

        return $saleOrder;
    }

    /**
     * Cancel the specified resource from storage.
     *
     * @param  \App\Http\Requests\Product\SaleOrderProductRequest  $request
     * @param  int  $saleOrderId
     * @return \Illuminate\Http\Response
     */
    public function cancel(SaleOrderRequest $request, $saleOrderId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->products()->update(['canceled_quantity' => DB::raw('quantity')]);
        
        $saleOrder->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'status', 'products']);

        $saleOrder->setAmount();
        $saleOrder->setStatus();
        $saleOrder->save();

        return $saleOrder;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $saleOrderId
     * @return \Illuminate\Http\Response
     */
    public function destroy($saleOrderId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->delete();

        return $saleOrder;
    }
}
