<?php

namespace App\Providers;

use App\Events\Staff\BillPayment\BillPaymentCanceled;
use App\Listeners\Staff\BillPayment\SetBillPaymentBillReturnedStatus;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Staff\Business\Business;
use App\Observers\Staff\BusinessObserver;
use App\Observers\Staff\BillServiceObserver;
use App\Listeners\Staff\BusinessServicePriceEventSubscriber;
use App\Models\Staff\Bill\BillPayment;
use App\Models\Staff\Bill\BillService;
use App\Observers\Staff\BillPaymentObserver;
use App\Events\UserBroadcastEvent;
use App\Listeners\UserBroadcastEventListener;
use App\Events\CustomerBroadcastEvent;
use App\Listeners\CustomerBroadcastEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        BillPaymentCanceled::class => [
            SetBillPaymentBillReturnedStatus::class,
        ],
        UserBroadcastEvent::class => [
            UserBroadcastEventListener::class,
        ],
        CustomerBroadcastEvent::class => [
            CustomerBroadcastEventListener::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        BusinessServicePriceEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Business::observe(BusinessObserver::class);
        BillService::observe(BillServiceObserver::class);
        BillPayment::observe(BillPaymentObserver::class);
    }
}
