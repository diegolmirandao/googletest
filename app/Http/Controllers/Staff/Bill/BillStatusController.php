<?php

namespace App\Http\Controllers\Staff\Bill;

use App\Http\Controllers\Controller;
use App\Models\Staff\Bill\BillStatus;
use Illuminate\Http\Request;

class BillStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billStatuses = BillStatus::all();

        return $billStatuses;
    }
}
