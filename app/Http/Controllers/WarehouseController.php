<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\WarehouseRequest;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();

        return $warehouses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\warehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        $warehouse = Warehouse::create($request->validated());

        return $warehouse;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $warehouseId
     * @return \Illuminate\Http\Response
     */
    public function show($warehouseId)
    {
        $warehouse = Warehouse::findOrFail($warehouseId);
        return $warehouse;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\WarehouseRequest  $request
     * @param  int  $warehouseId
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseRequest $request, $warehouseId)
    {
        $warehouse = Warehouse::findOrFail($warehouseId);
        $warehouse->update($request->validated());

        return $warehouse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $warehouseId
     * @return \Illuminate\Http\Response
     */
    public function destroy($warehouseId)
    {
        $warehouse = Warehouse::findOrFail($warehouseId);
        $warehouse->delete();

        return $warehouse;
    }
}
