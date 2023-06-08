<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();

        return $currencies;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $currency = Currency::create($request->validated());
        $currency->exchangeRates()->create(['exchange_rate' => $request->validated()['exchange_rate']]);

        return $currency;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $currencyId
     * @return \Illuminate\Http\Response
     */
    public function show($currencyId)
    {
        $currency = Currency::findOrFail($currencyId);
        return $currency;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyRequest  $request
     * @param  int  $currencyId
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, $currencyId)
    {
        $currency = Currency::findOrFail($currencyId);
        $currency->update($request->validated());
        $currency->exchangeRates()->create(['exchange_rate' => $request->validated()['exchange_rate']]);

        return $currency;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $currencyId
     * @return \Illuminate\Http\Response
     */
    public function destroy($currencyId)
    {
        $currency = Currency::findOrFail($currencyId);
        $currency->delete();

        return $currency;
    }
}
