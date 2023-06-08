<?php

namespace App\Http\Controllers\Staff\Service;

use App\Http\Controllers\Controller;
use App\Models\Staff\Service\BillingCycle;

class BillingCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billingCycles = BillingCycle::all();

        return $billingCycles;
    }
}
