<?php

namespace App\Events\Staff\BusinessServicePrice;

use App\Models\Staff\Business\BusinessServicePrice;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BusinessServicePriceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The BusinessServicePrice instance.
     *
     * @var \App\Models\BusinessServicePrice
     */
    public $businessServicePrice;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BusinessServicePrice $businessServicePrice)
    {
        $this->businessServicePrice = $businessServicePrice;
    }
}
