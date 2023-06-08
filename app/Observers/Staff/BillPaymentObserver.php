<?php

namespace App\Observers\Staff;

use App\Models\Staff\Bill\BillPayment;

class BillPaymentObserver
{
    /**
     * Handle the BillPayment "saved" event.
     *
     * @param  \App\Models\BillPayment  $billPayment
     * @return void
     */
    public function saved(BillPayment $billPayment)
    {
        $billPayment->bill->setPaidAmount();
        $billPayment->bill->setPaidAt();
        $billPayment->bill->setBillStatusId();

        $billPayment->bill->saveQuietly();
    }

    /**
     * Handle the BillPayment "deleted" event.
     *
     * @param  \App\Models\BillPayment  $billPayment
     * @return void
     */
    public function deleted(BillPayment $billPayment)
    {
        $billPayment->bill->setReturnedPaymentBillStatusId();
        $billPayment->bill->setPaidAmount();
        $billPayment->bill->setPaidAt();
        $billPayment->bill->saveQuietly();
    }

    /**
     * Handle the BillPayment "restored" event.
     *
     * @param  \App\Models\BillPayment  $billPayment
     * @return void
     */
    public function restored(BillPayment $billPayment)
    {
        $billPayment->bill->setPaidAmount();
        $billPayment->bill->setPaidAt();
        $billPayment->bill->setBillStatusId();

        $billPayment->bill->saveQuietly();
    }

    /**
     * Handle the BillPayment "force deleted" event.
     *
     * @param  \App\Models\BillPayment  $billPayment
     * @return void
     */
    public function forceDeleted(BillPayment $billPayment)
    {
        $billPayment->bill->setReturnedPaymentBillStatusId();
        $billPayment->bill->saveQuietly();
    }
}
