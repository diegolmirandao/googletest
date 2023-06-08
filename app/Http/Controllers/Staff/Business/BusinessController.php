<?php

namespace App\Http\Controllers\Staff\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Business\BusinessRequest;
use App\Models\Staff\Business\Business;
use App\Models\Tenant;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['direct_permission:business.view'])->only('index', 'show');
        $this->middleware(['direct_permission:business.create'])->only('store');
        $this->middleware(['direct_permission:business.update'])->only('update');
        $this->middleware(['direct_permission:business.delete'])->only('destroy');
        $this->middleware(['direct_permission:business.activate'])->only('activate');
        $this->middleware(['direct_permission:business.assign'])->only('assign');
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

        $businesses = Business::orderBy('id', 'desc')
                    ->paginate($page_size);

        return $businesses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BusinessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessRequest $request)
    {
        $business = Business::create($request->safe()->except(['services']));
        $business->services()->createMany($request->validated()['services']);
        $business->load(['services', 'features']);
        
        return $business;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        $this->authorize('view', $business);
        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BusinessRequest  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessRequest $request, Business $business)
    {
        $this->authorize('update', $business);

        $business->update($request->validated());
        $business->load(['services', 'features']);

        return $business;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessRequest $request, Business $business)
    {
        $this->authorize('delete', $business);

        $business->delete();

        return $business;
    }

    /**
     * Activate business account and create tenant.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function activate(BusinessRequest $request, Business $business)
    {
        $this->authorize('activate', $business);

        $business->update(['status' => true, 'confirmed_at' => now()]);

        $tenant = Tenant::create();
        $tenant->domains()->create(['domain' => $business->sub_domain]);
        $tenant->business()->save($business);

        $business->load(['services', 'features']);
        
        return $business;
    }

    /**
     * Assign user to business.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function assign(BusinessRequest $request, Business $business) {
        $business->users()->attach($request->user_id);
        $business->load(['services', 'features']);

        return $business;
    }
}
