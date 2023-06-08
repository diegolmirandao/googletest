<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\ZoneRequest;
use App\Models\Location\Zone;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();

        return $zones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        $zone = Zone::create($request->validated());

        return $zone;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $zoneId
     * @return \Illuminate\Http\Response
     */
    public function show($zoneId)
    {
        $zone = Zone::findOrFail($zoneId);
        return $zone;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ZoneRequest  $request
     * @param  int  $zoneId
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, $zoneId)
    {
        $zone = Zone::findOrFail($zoneId);
        $zone->update($request->validated());

        return $zone;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $zoneId
     * @return \Illuminate\Http\Response
     */
    public function destroy($zoneId)
    {
        $zone = Zone::findOrFail($zoneId);
        $zone->delete();

        return $zone;
    }
}
