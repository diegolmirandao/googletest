<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentTermRequest;
use App\Models\PaymentTerm;

class PaymentTermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentTerms = PaymentTerm::all();

        return $paymentTerms;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentTermRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentTermRequest $request)
    {
        $paymentTerm = PaymentTerm::create($request->validated());

        return $paymentTerm;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $paymentTermId
     * @return \Illuminate\Http\Response
     */
    public function show($paymentTermId)
    {
        $paymentTerm = PaymentTerm::findOrFail($paymentTermId);
        return $paymentTerm;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentTermRequest  $request
     * @param  int  $paymentTermId
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentTermRequest $request, $paymentTermId)
    {
        $paymentTerm = PaymentTerm::findOrFail($paymentTermId);
        $paymentTerm->update($request->validated());

        return $paymentTerm;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $paymentTermId
     * @return \Illuminate\Http\Response
     */
    public function destroy($paymentTermId)
    {
        $paymentTerm = PaymentTerm::findOrFail($paymentTermId);
        $paymentTerm->delete();

        return $paymentTerm;
    }
}
