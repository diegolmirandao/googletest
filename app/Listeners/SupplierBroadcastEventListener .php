<?php

namespace App\Listeners;

use App\Events\SupplierBroadcastEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SupplierBroadcastEventListener
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
     * @param  \App\Events\SupplierBroadcastEvent  $event
     * @return void
     */
    public function handle(SupplierBroadcastEvent $event)
    {
        $syncs = [];

        foreach ($event->devices as $device) {
            array_push($syncs, ['device_id' => $device->id]);
        }

        $event->supplier->devices()->attach($syncs);
    }
}
