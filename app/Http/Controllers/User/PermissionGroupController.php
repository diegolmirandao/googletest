<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissionGroups = PermissionGroup::all();

        return $permissionGroups;
    }
}
