<?php

namespace App\Listeners\Staff\BusinessFeature;

class AddServiceFeaturesToBusiness
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
        $serviceFeatures = $event->businessServicePrice->servicePrice->service->features;
        $currentFeaturesIds = $event->businessServicePrice->business->features->pluck('feature_id');
        $newFeatures = $serviceFeatures->whereNotIn('feature_id', $currentFeaturesIds)->map->only('feature_id', 'quantity');
        $event->businessServicePrice->business->features()->createMany($newFeatures);
        $repeatedFeatures = $serviceFeatures->whereIn('feature_id', $currentFeaturesIds)->map->only('feature_id', 'quantity');
        foreach ($repeatedFeatures as $repeatedFeature) {
            $event->businessServicePrice->business->features()
                                                ->where('feature_id', $repeatedFeature['feature_id'])
                                                ->increment('quantity', $repeatedFeature['quantity']);
        }
    }
}
