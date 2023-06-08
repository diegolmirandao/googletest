<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\RegionRequest;
use App\Models\Location\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();

        return $regions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request)
    {
        $region = Region::create($request->validated());

        return $region;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $regionId
     * @return \Illuminate\Http\Response
     */
    public function show($regionId)
    {
        $region = Region::findOrFail($regionId);
        return $region;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RegionRequest  $request
     * @param  int  $regionId
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, $regionId)
    {
        $region = Region::findOrFail($regionId);
        $region->update($request->validated());

        return $region;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $regionId
     * @return \Illuminate\Http\Response
     */
    public function destroy($regionId)
    {
        $region = Region::findOrFail($regionId);
        $region->delete();

        return $region;
    }
}
