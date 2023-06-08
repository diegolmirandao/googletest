<?php
 
namespace App\Listeners\Staff;

use App\Events\Staff\BusinessServicePrice\BusinessServicePriceActivated;
use App\Events\Staff\BusinessServicePrice\BusinessServicePriceSuspended;
use App\Events\Staff\BusinessServicePrice\BusinessServicePriceCanceled;
use App\Listeners\Staff\BusinessFeature\AddServiceFeaturesToBusiness;
use App\Listeners\Staff\BusinessFeature\RemoveServiceFeaturesToBusiness;
use App\Listeners\Staff\BusinessServicePrice\SetBusinessServicePriceNextExpirationAt;

class BusinessServicePriceEventSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        // Activated Event

        $events->listen(
            BusinessServicePriceActivated::class, [AddServiceFeaturesToBusiness::class, 'handle']
        );

        $events->listen(
            BusinessServicePriceActivated::class, [SetBusinessServicePriceNextExpirationAt::class, 'handle']
        );

        // Suspended Event

        $events->listen(
            BusinessServicePriceSuspended::class, [RemoveServiceFeaturesToBusiness::class, 'handle']
        );

        // Canceled Event

        $events->listen(
            BusinessServicePriceCanceled::class, [RemoveServiceFeaturesToBusiness::class, 'handle']
        );
    }
}