<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale\Sale;
use Illuminate\Http\Request;

class AccountReceivableController extends Controller
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
        $sales = Sale::outstandingBalance()->filter()->cursorPaginate($pageSize);
        return $sales;
    }
}
