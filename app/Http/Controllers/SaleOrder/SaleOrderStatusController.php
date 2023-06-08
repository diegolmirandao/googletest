<?php

namespace App\Http\Controllers\SaleOrder;

use App\Http\Controllers\Controller;
use App\Models\SaleOrder\SaleOrderStatus;

class SaleOrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleOrderStatuses = SaleOrderStatus::all();

        return $saleOrderStatuses;
    }
}
