<?php

namespace App\Http\Controllers\User;

use App\Events\UserBroadcastEvent;
use App\Http\Requests\User\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:user.view'])->only('index', 'show');
        $this->middleware(['direct_permission:user.create'])->only('store');
        $this->middleware(['direct_permission:user.update'])->only('update');
        $this->middleware(['direct_permission:user.delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_size = $request->filled('page_size') ? $request->page_size : config('constants.default_page_size');
        $users = User::filter()->cursorPaginate($page_size);
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->safe()->except('role_id', 'permissions'));
        $user->assignRole($request->role_id);

        $permissions = $request->permissions;
        $user->givePermissionTo($permissions);

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        UserBroadcastEvent::dispatch($user, 'add', $devices);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $userId)
    {
        $user = User::findOrFail($userId);
        $user->setSynced($request->cookie('Device-Id'));

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, int $userId)
    {
        $user = User::findOrFail($userId);

        $user->update($request->safe()->except(['password', 'role_id', 'permissions']));
        $user->syncRoles($request->role_id);

        $permissions = $request->permissions;
        $user->syncPermissions($permissions);

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        UserBroadcastEvent::dispatch($user, 'update', $devices);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $request, int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        // Event Broadcast
        $devices = Device::active()->excludeDevice($request->cookie('Device-Id'))->get();
        UserBroadcastEvent::dispatch($userId, 'delete', $devices);

        return $userId;
    }
}
