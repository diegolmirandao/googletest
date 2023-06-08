<?php

namespace App\Http\Controllers\Staff\Bill;

use App\Http\Controllers\Controller;
use App\Events\Staff\BillPayment\BillPaymentCanceled;
use App\Http\Requests\Staff\Bill\BillPaymentRequest;
use App\Models\Staff\Bill\Bill;
use App\Models\Staff\Bill\BillPayment;

class BillPaymentController extends Controller
{
    public function __construct() {
        $this->middleware(['direct_permission:bill_payment.create'])->only('store');
        $this->middleware(['direct_permission:bill_payment.update'])->only('update');
        $this->middleware(['direct_permission:bill_payment.delete'])->only('destroy');
        $this->middleware(['direct_permission:bill_payment.cancel'])->only('cancel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BillPaymentRequest  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function store(BillPaymentRequest $request, Bill $bill)
    {
        $bill->payments()->create($request->validated());
        $bill->load(['payments', 'services']);

        return $bill;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BillPaymentRequest  $request
     * @param  \App\Models\Bill  $bill
     * @param  \App\Models\BillPayment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(BillPaymentRequest $request, Bill $bill, BillPayment $payment)
    {
        $bill->payments()->findOrFail($payment->id)->update($request->validated());
        $bill->load(['payments', 'services']);

        return $bill;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @param  \App\Models\BillPayment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill, BillPayment $payment)
    {
        $bill->payments()->findOrFail($payment->id)->delete();
        $bill->load(['payments', 'services']);

        return $bill;
    }

    /**
     * Cancel the specified resource from storage.
     *
     * @param  \App\Http\Requests\BillPaymentRequest  $request
     * @param  \App\Models\BillPayment  $payment
     * @return \Illuminate\Http\Response
     */
    public function cancel(BillPaymentRequest $request, Bill $bill, BillPayment $payment)
    {
        $billPayment = $bill->payments()->findOrFail($payment->id);
        $billPayment->setCanceledAt();
        $billPayment->saveQuietly();

        BillPaymentCanceled::dispatch($billPayment);

        $bill->load(['payments', 'services']);

        return $bill;
    }
}
