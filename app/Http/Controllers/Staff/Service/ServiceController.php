<?php

namespace App\Http\Controllers\Staff\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Service\ServiceRequest;
use App\Models\Staff\Service\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:service.view'])->only('index', 'show');
        $this->middleware(['direct_permission:service.create'])->only('store');
        $this->middleware(['direct_permission:service.update'])->only('update');
        $this->middleware(['direct_permission:service.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_size = $request->filled('page_size') ? $request->page_size : config('constants.default_page_size');
        $services = Service::paginate($page_size);
        return $services;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->safe()->except(['prices', 'features']));
        $service->prices()->createMany($request->validated()['prices']);
        $service->features()->createMany($request->validated()['features']);
        $service->load(['prices', 'features']);

        return $service;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $service->load(['prices', 'features']);

        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        $service->load(['prices', 'features']);
        
        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $request, Service $service)
    {
        $service->delete();

        return $service;
    }
}
