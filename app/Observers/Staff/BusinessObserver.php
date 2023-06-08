<?php

namespace App\Observers\Staff;

use App\Models\Staff\Business\Business;
use Illuminate\Support\Str;


class BusinessObserver
{
    /**
     * Handle the Business "created" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function creating(Business $business)
    {   
        $business->sub_domain = Str::slug($business->name, '');
    }

    /**
     * Handle the Business "updated" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function updating(Business $business)
    {
        $business->sub_domain = Str::slug($business->name, '');
    }

    /**
     * Handle the Business "deleted" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function deleted(Business $business)
    {
        //
    }

    /**
     * Handle the Business "restored" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function restored(Business $business)
    {
        //
    }

    /**
     * Handle the Business "force deleted" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function forceDeleted(Business $business)
    {
        //
    }
}
