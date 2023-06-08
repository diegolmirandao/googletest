<?php

namespace App\Http\Controllers\Staff\Bill;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Bill\BillRequest;
use App\Models\Staff\Bill\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:bill.view'])->only('index', 'show');
        $this->middleware(['direct_permission:bill.create'])->only('store');
        $this->middleware(['direct_permission:bill.update'])->only('update');
        $this->middleware(['direct_permission:bill.delete'])->only('destroy');
        $this->middleware(['direct_permission:bill.cancel'])->only('cancel');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->filled('page_size') ? $request->page_size : config('constants.default_page_size');
        $bills = Bill::paginate($pageSize);
        return $bills;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        $bill = Bill::create($request->validated());
        $bill->services()->createMany($request->services);
        $bill->load(['billStatus', 'currency', 'business', 'payments', 'services']);

        return $bill;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        $this->authorize('view', $bill);

        $bill->load(['payments', 'services']);
        
        return $bill;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillRequest  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(BillRequest $request, Bill $bill)
    {
        $this->authorize('update', $bill);

        $bill->update($request->validated());
        $bill->load(['payments', 'services']);
        
        return $bill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillRequest $request, Bill $bill)
    {
        $this->authorize('delete', $bill);

        $bill->delete();

        return $bill;
    }

    /**
     * Cancel the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function cancel(BillRequest $request, Bill $bill)
    {
        $this->authorize('cancel', $bill);

        $bill->setCanceledBillStatusId();
        $bill->setCanceledAt();
        $bill->saveQuietly();
        foreach ($bill->payments()->get() as $payment) {
            $payment->setCanceledAt();
            $payment->saveQuietly();
        }

        $bill->load(['payments', 'services']);

        return $bill;
    }
}
