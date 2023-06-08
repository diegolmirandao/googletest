<?php

namespace App\Http\Controllers;

class InitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function init()
    {
        $models = config('init.models');
        $initData = array();

        foreach ($models as $key => $model) {
            $initData[$key] = $model::all(); 
        }

        return $initData;
    }
}
