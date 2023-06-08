<?php

namespace App\Http\Controllers\SaleOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleOrder\SaleOrderProductRequest;
use App\Models\SaleOrder\SaleOrder;

class SaleOrderProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\SaleOrderProductRequest  $request
     * @param  int  $saleOrderId
     * @return \Illuminate\Http\Response
     */
    public function store(SaleOrderProductRequest $request, $saleOrderId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->products()->createMany($request->validated());

        $saleOrder->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'status', 'products']);

        $saleOrder->setAmount();
        $saleOrder->setStatus();
        $saleOrder->save();

        return $saleOrder;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\SaleOrderProductRequest  $request
     * @param  int  $saleOrderId
     * @param  int  $saleOrderProductId
     * @return \Illuminate\Http\Response
     */
    public function update(SaleOrderProductRequest $request, $saleOrderId, $saleOrderProductId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->products()->findOrFail($saleOrderProductId)->update($request->validated());

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
     * @param  int  $saleOrderProductId
     * @return \Illuminate\Http\Response
     */
    public function cancel(SaleOrderProductRequest $request, $saleOrderId, $saleOrderProductId)
    {
        $canceledQuantity = $request->validated()['quantity'];
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->products()->findOrFail($saleOrderProductId)->update(['canceled_quantity' => $canceledQuantity]);
        
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
     * @param  int  $saleOrderProductId
     * @return \Illuminate\Http\Response
     */
    public function destroy($saleOrderId, $saleOrderProductId)
    {
        $saleOrder = SaleOrder::findOrFail($saleOrderId);
        $saleOrder->products()->findOrFail($saleOrderProductId)->delete();

        $saleOrder->setAmount();
        $saleOrder->setStatus();
        $saleOrder->save();
        
        $saleOrder->load(['customer', 'currency', 'establishment', 'pointOfSale', 'warehouse', 'seller', 'status', 'products']);

        return $saleOrder;
    }
}
