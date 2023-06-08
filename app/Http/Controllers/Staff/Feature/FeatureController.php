<?php

namespace App\Http\Controllers\Staff\Feature;

use App\Http\Controllers\Controller;
use App\Models\Staff\Feature\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $features = Feature::all();
        return $features;
    }
}
