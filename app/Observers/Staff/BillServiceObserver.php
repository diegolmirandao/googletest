<?php

namespace App\Observers\Staff;

use App\Models\Staff\Bill\BillService;

class BillServiceObserver
{
    /**
     * Handle the BillService "created" event.
     *
     * @param  \App\Models\BillService  $billService
     * @return void
     */
    public function created(BillService $billService)
    {   
        $billService->refresh();

        /* BillService Setters */
        $billService->setDescription();
        $billService->setCoversFrom();
        $billService->setCoversTo();
        $billService->saveQuietly();

        /* BillService Bill Setters */
        $billService->bill->setAmount();
        $billService->bill->setPaidAmount();
        $billService->bill->setExpiratesAt();
        $billService->bill->setPaidAt();
        $billService->bill->setBillStatusId();
        $billService->bill->saveQuietly();

        /* BillService BusinesServicePrice Setters */
        $billService->businessServicePrice->setLastExpirationAt();
        $billService->businessServicePrice->setNextExpirationAt();
        $billService->businessServicePrice->saveQuietly();
    }

    /**
     * Handle the BillService "saved" event.
     *
     * @param  \App\Models\BillService  $billService
     * @return void
     */
    public function updated(BillService $billService)
    {
        $businessServicePriceIdChanged = $billService->isDirty('business_service_price_id');
        
        $billService->refresh();

        /* BillService Setters */
        $billService->setDescription();
        
        if($businessServicePriceIdChanged) {
            $billService->setCoversFrom();
            $billService->setCoversTo();
        }

        $billService->saveQuietly();

        /* BillService Bill Setters */
        $billService->bill->setAmount();
        $billService->bill->setPaidAmount();
        $billService->bill->setExpiratesAt();
        $billService->bill->setPaidAt();
        $billService->bill->setBillStatusId();
        $billService->bill->saveQuietly();

        /* BillService BusinesServicePrice Setters */
        $billService->businessServicePrice->setLastExpirationAt();
        $billService->businessServicePrice->setNextExpirationAt();
        $billService->businessServicePrice->saveQuietly();
    }
    
    /**
     * Handle the BillService "deleted" event.
     *
     * @param  \App\Models\BillService  $billService
     * @return void
     */
    public function deleted(BillService $billService)
    {
        $billService->refresh();
        
        /* BillService Bill Setters */
        $billService->bill->setAmount();
        $billService->bill->setPaidAmount();
        $billService->bill->setExpiratesAt();
        $billService->bill->setPaidAt();
        $billService->bill->setBillStatusId();
        $billService->bill->saveQuietly();

        /* BillService BusinesServicePrice Setters */
        $billService->businessServicePrice->setLastExpirationAt();
        $billService->businessServicePrice->setNextExpirationAt();
        $billService->businessServicePrice->saveQuietly();
    }
}
