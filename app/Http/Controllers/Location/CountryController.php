<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\CountryRequest;
use App\Models\Location\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::with(['regions', 'regions.cities', 'regions.cities', 'regions.cities.zones'])->get();

        return $countries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->validated());

        return $country;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $countryId
     * @return \Illuminate\Http\Response
     */
    public function show($countryId)
    {
        $country = Country::findOrFail($countryId);
        return $country;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @param  int  $countryId
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $countryId)
    {
        $country = Country::findOrFail($countryId);
        $country->update($request->validated());

        return $country;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $countryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($countryId)
    {
        $country = Country::findOrFail($countryId);
        $country->delete();

        return $country;
    }
}
