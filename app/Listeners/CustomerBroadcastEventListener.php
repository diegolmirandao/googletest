<?php

namespace App\Listeners;

use App\Events\CustomerBroadcastEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomerBroadcastEventListener
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
     * @param  \App\Events\CustomerBroadcastEvent  $event
     * @return void
     */
    public function handle(CustomerBroadcastEvent $event)
    {
        $syncs = [];

        foreach ($event->devices as $device) {
            array_push($syncs, ['device_id' => $device->id]);
        }

        $event->customer->devices()->attach($syncs);
    }
}
