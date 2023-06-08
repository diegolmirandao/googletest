<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        $paymentMethod = PaymentMethod::create($request->validated());

        return $paymentMethod;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $paymentMethodId
     * @return \Illuminate\Http\Response
     */
    public function show($paymentMethodId)
    {
        $paymentMethod = PaymentMethod::findOrFail($paymentMethodId);
        return $paymentMethod;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentMethodRequest  $request
     * @param  int  $paymentMethodId
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodRequest $request, $paymentMethodId)
    {
        $paymentMethod = PaymentMethod::findOrFail($paymentMethodId);
        $paymentMethod->update($request->validated());

        return $paymentMethod;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $paymentMethodId
     * @return \Illuminate\Http\Response
     */
    public function destroy($paymentMethodId)
    {
        $paymentMethod = PaymentMethod::findOrFail($paymentMethodId);
        $paymentMethod->delete();

        return $paymentMethod;
    }
}
