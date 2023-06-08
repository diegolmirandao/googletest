<?php

namespace App\Http\Controllers\Staff\Service;

use App\Http\Controllers\Controller;
use App\Models\Staff\Service\ServicePriceType;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Http\Requests\Staff\Service\ServicePriceTypeRequest;

class ServicePriceTypeController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:service_price_type.view'])->only('index', 'show');
        $this->middleware(['direct_permission:service_price_type.create'])->only('create');
        $this->middleware(['direct_permission:service_price_type.update'])->only('update');
        $this->middleware(['direct_permission:service_price_type.delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\ServicePriceTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ServicePriceTypeRequest $request)
    {
        $servicePriceTypes = ServicePriceType::all();

        return $servicePriceTypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServicePriceTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicePriceTypeRequest $request)
    {
        $servicePriceType = ServicePriceType::create($request->validated());
        $permission = Permission::create([
            'name' => 'service_price_type.sell_price_type_'.$servicePriceType->id,
            'permission_group_id' => 5,
            'guard_name' => 'sanctum',
        ]);
        Role::find(1)->givePermissionTo($permission->id);
        // $users = User::whereHas('roles', function($query){
        //     $query->where('roles.id', 1);
        // })->get();
        // foreach ($users as $user) {
        //     User::find($user->id)->givePermissionTo($permission->id);
        // }
        return $servicePriceType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicePriceType  $servicePriceType
     * @return \Illuminate\Http\Response
     */
    public function show(ServicePriceType $servicePriceType)
    {
        return $servicePriceType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServicePriceTypeRequest  $request
     * @param  \App\Models\ServicePriceType  $servicePriceType
     * @return \Illuminate\Http\Response
     */
    public function update(ServicePriceTypeRequest $request, ServicePriceType $servicePriceType)
    {
        $servicePriceType->update($request->validated());
        
        return $servicePriceType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\ServicePriceTypeRequest  $request
     * @param  \App\Models\ServicePriceType  $servicePriceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePriceTypeRequest $request, ServicePriceType $servicePriceType)
    {
        $servicePriceType->delete();

        return $servicePriceType;
    }
}
