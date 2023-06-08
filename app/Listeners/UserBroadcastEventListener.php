<?php

namespace App\Listeners;

use App\Events\UserBroadcastEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserBroadcastEventListener
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
     * @param  \App\Events\UserBroadcastEvent  $event
     * @return void
     */
    public function handle(UserBroadcastEvent $event)
    {
        if ($event->type !== 'delete') {
            $syncs = [];

            foreach ($event->devices as $device) {
                array_push($syncs, ['device_id' => $device->id]);
            }

            $event->user->devices()->attach($syncs);
        }
    }
}
