<?php

namespace App\Listeners\Staff\BillPayment;

class SetBillPaymentBillReturnedStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->billPayment->bill->setReturnedPaymentBillStatusId();
        $event->billPayment->bill->saveQuietly();
    }
}
