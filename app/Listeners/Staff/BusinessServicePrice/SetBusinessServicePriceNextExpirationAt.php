<?php

namespace App\Listeners\Staff\BusinessServicePrice;

class SetBusinessServicePriceNextExpirationAt
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
        $event->businessServicePrice->setNextExpirationAt();
        $event->businessServicePrice->save();
    }
}
