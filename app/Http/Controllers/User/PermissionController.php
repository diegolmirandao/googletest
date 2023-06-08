<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PermissionRequest;
use App\Models\User\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:permission.view'])->only('index', 'show');
        $this->middleware(['direct_permission:permission.create'])->only('store');
        $this->middleware(['direct_permission:permission.update'])->only('update');
        $this->middleware(['direct_permission:permission.delete'])->only('destroy');
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
        $permissions = Permission::orderBy('id', 'desc')
                        ->paginate($page_size);

        return $permissions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = Permission::create($request->validated());
        
        return $permission;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return $permission;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return $permission;
    }

    /**
     * Display a listing of the resource with goups.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionsByGroup() {
        $permissions = Permission::all()->groupBy('permissionGroup.name');

        return $permissions;
    }
}
