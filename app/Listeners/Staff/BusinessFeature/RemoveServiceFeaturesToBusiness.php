<?php

namespace App\Listeners\Staff\BusinessFeature;

class RemoveServiceFeaturesToBusiness
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
        $serviceFeatures = $event->businessServicePrice->servicePrice->service->features->map->only('feature_id', 'quantity');
        foreach ($serviceFeatures as $serviceFeature) {
            $event->businessServicePrice->business->features()
                                                ->where('feature_id', $serviceFeature['feature_id'])
                                                ->decrement('quantity', $serviceFeature['quantity']);
        }
        $event->businessServicePrice->business->features()->where('quantity', '<=', 0)->delete();
    }
}
