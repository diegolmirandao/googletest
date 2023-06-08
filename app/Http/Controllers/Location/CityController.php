<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\CityRequest;
use App\Models\Location\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return $cities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->validated());

        return $city;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $cityId
     * @return \Illuminate\Http\Response
     */
    public function show($cityId)
    {
        $city = City::findOrFail($cityId);
        return $city;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CityRequest  $request
     * @param  int  $cityId
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $cityId)
    {
        $city = City::findOrFail($cityId);
        $city->update($request->validated());

        return $city;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $cityId
     * @return \Illuminate\Http\Response
     */
    public function destroy($cityId)
    {
        $city = City::findOrFail($cityId);
        $city->delete();

        return $city;
    }
}
