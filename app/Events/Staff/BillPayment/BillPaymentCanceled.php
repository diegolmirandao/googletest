<?php

namespace App\Events\Staff\BillPayment;

use App\Models\Staff\Bill\BillPayment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BillPaymentCanceled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The BillPayment instance.
     *
     * @var \App\Models\BillPayment
     */
    public $billPayment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BillPayment $billPayment)
    {
        $this->billPayment = $billPayment;
    }
}
