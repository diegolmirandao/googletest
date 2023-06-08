<?php

namespace App\Http\Controllers\Staff\Feature;

use App\Http\Controllers\Controller;
use App\Models\Staff\Feature\FeatureGroup;
use Illuminate\Http\Request;

class FeatureGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featureGroups = FeatureGroup::all();
        return $featureGroups;
    }
}
