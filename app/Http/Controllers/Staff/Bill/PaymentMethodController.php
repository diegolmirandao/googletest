<?php

namespace App\Http\Controllers\Staff\Bill;

use App\Http\Controllers\Controller;
use App\Models\Staff\Bill\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();

        return $paymentMethods;
    }
}
