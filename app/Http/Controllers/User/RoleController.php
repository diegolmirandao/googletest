<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RoleRequest;
use App\Models\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:role.view'])->only('index', 'show');
        $this->middleware(['direct_permission:role.create'])->only('create');
        $this->middleware(['direct_permission:role.update'])->only('update');
        $this->middleware(['direct_permission:role.delete'])->only('destroy');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::all();

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->safe()->except('permissions'));
        $permissions = $request->permissions;
        $role->givePermissionTo($permissions);

        return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $role;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->safe()->except('permissions'));
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);

        return $role;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return $role;
    }
}
