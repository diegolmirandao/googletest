<?php

namespace App\Http\Controllers\Staff\Business;

use App\Http\Controllers\Controller;
use App\Models\Staff\Business\BusinessServiceStatus;
use Illuminate\Http\Request;

class BusinessServiceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessServicesStatuses = BusinessServiceStatus::all();

        return $businessServicesStatuses;
    }
}
