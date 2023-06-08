<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AcquisitionChannelRequest;
use App\Models\Customer\AcquisitionChannel;

class AcquisitionChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acquisitionChannels = AcquisitionChannel::all();

        return $acquisitionChannels;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AcquisitionChannelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcquisitionChannelRequest $request)
    {
        $acquisitionChannel = AcquisitionChannel::create($request->validated());

        return $acquisitionChannel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $acquisitionChannelId
     * @return \Illuminate\Http\Response
     */
    public function show($acquisitionChannelId)
    {
        $acquisitionChannel = AcquisitionChannel::findOrFail($acquisitionChannelId);
        return $acquisitionChannel;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AcquisitionChannelRequest  $request
     * @param  int  $acquisitionChannelId
     * @return \Illuminate\Http\Response
     */
    public function update(AcquisitionChannelRequest $request, $acquisitionChannelId)
    {
        $acquisitionChannel = AcquisitionChannel::findOrFail($acquisitionChannelId);
        $acquisitionChannel->update($request->validated());

        return $acquisitionChannel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $acquisitionChannelId
     * @return \Illuminate\Http\Response
     */
    public function destroy($acquisitionChannelId)
    {
        $acquisitionChannel = AcquisitionChannel::findOrFail($acquisitionChannelId);
        $acquisitionChannel->delete();

        return $acquisitionChannel;
    }
}
