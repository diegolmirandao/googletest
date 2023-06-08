<?php

namespace App\Http\Controllers\Staff\Bill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Bill\BillServiceRequest;
use App\Models\Staff\Bill\Bill;
use App\Models\Staff\Bill\BillService;

class BillServiceController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:bill_service.create'])->only('store');
        $this->middleware(['direct_permission:bill_service.update'])->only('update');
        $this->middleware(['direct_permission:bill_service.delete'])->only('destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BillServiceRequest  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function store(BillServiceRequest $request, Bill $bill)
    {
        $bill->services()->create($request->validated());
        $bill->load(['payments', 'services']);

        return $bill;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BillServiceRequest  $request
     * @param  \App\Models\Bill  $bill
     * @param  \App\Models\BillService  $Service
     * @return \Illuminate\Http\Response
     */
    public function update(BillServiceRequest $request, Bill $bill, BillService $service)
    {
        $bill->services()->findOrFail($service->id)->update($request->validated());
        $bill->load(['payments', 'services']);

        return $bill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * * @param  \App\Http\Requests\BillServiceRequest  $request
     * @param  \App\Models\Bill  $bill
     * @param  \App\Models\BillService  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillServiceRequest $request, Bill $bill, BillService $service)
    {
        $bill->services()->findOrFail($service->id)->delete();
        $bill->load(['payments', 'services']);

        return $bill;
    }
}
