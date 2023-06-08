<?php

namespace App\Models\Staff\Business;

use App\Models\Staff\Bill\BillService;
use App\Models\Staff\Service\ServicePrice;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;

class BusinessServicePrice extends Model
{
    use CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_price_id',
        'quantity',
        'business_service_status_id',
        'activated_at',
        'suspended_at',
        'canceled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'activated_at' => 'datetime',
        'suspended_at' => 'datetime',
        'canceled_at' => 'datetime',
        'last_expiration_at' => 'datetime',
        'next_expiration_at' => 'datetime',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'servicePrice',
        'servicePrice.service',
        'status',
        'createdBy',
        'updatedBy'
    ];

    public function status() {
        return $this->businessServiceStatus();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function businessServiceStatus()
    {
        return $this->belongsTo(BusinessServiceStatus::class);
    }

    public function servicePrice() {
        return $this->belongsTo(ServicePrice::class);
    }

    public function billServices()
    {
        return $this->hasMany(BillService::class);
    }

    public function getLatestBillService()
    {
        return $this->billServices()
                    ->latest()
                    ->first();
    }

    public function setLastExpirationAt()
    {
        $this->last_expiration_at = $this->hasBillServices() ? $this->getLatestBillService()->covers_to : null;
    }

    public function setNextExpirationAt()
    {
        $date = null;
        
        if ($this->hasBillServices()) {
            $date = $this->getLatestBillService()->covers_to->add($this->servicePrice->billingCycle->period, $this->servicePrice->billingCycle->interval);
        } else {
            $date = $this->activated_at->add($this->servicePrice->billingCycle->period, $this->servicePrice->billingCycle->interval)
                    ->add($this->servicePrice->trial_period, $this->servicePrice->trial_interval);
        }

        $this->next_expiration_at = $date;
    }

    public function hasBillServices() {
        return $this->billServices->count();
    }

    public function isPending()
    {
        return $this->business_service_status_id == 1;
    }

    public function isActive()
    {
        return $this->business_service_status_id == 2;
    }

    public function isSuspended()
    {
        return $this->business_service_status_id == 3;
    }

    public function isCanceled()
    {
        return $this->business_service_status_id == 4;
    }

    public function scopeServicePrice($query, $id)
    {
        return $query->where('service_price_id', $id);
    }

    public function scopeBusiness($query, $id)
    {
        return $query->where('business_id', $id);
    }

    public function scopeActive($query)
    {
        return $query->where('business_service_status_id', 2);
    }
}
