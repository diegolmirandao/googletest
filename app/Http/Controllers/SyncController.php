<?php

namespace App\Http\Controllers;
use App\Models\Synchronizable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(Request $request)
    {
        $deviceId = $request->deviceId;
        $models = config('sync.models');
        $syncData = ['data' => array()];

        $page_size = $request->filled('page_size') ? $request->page_size : config('constants.sync_page_size');
        $syncs = Synchronizable::ofDevice($deviceId)->cursorPaginate($page_size);

        foreach($syncs as $sync) {
            $syncKey = $models[$sync->synchronizable_type];
            $syncData['data'][$syncKey][] = $sync->synchronizable;

            $sync->delete();
        }

        $paginationData = Arr::except($syncs->toArray(), 'data');
        $syncData = array_merge($syncData, $paginationData);

        return $syncData;
    }
}
