<?php

namespace App\Models\Staff\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Staff\Business\BusinessServicePrice;
use App\Models\Staff\Currency;

class ServicePrice extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy, EagerLoadPivotTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_price_type_id',
        'currency_id',
        'billing_cycle_id',
        'status',
        'amount',
        'trial_period',
        'trial_interval',
        'grace_period',
        'grace_interval',
        'bill_generation_period',
        'bill_generation_interval',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'type',
        'billingCycle',
        'currency',
        'createdBy',
        'updatedBy'
    ];

    public function servicePriceType()
    {
        return $this->belongsTo(ServicePriceType::class);
    }
    
    public function type()
    {
        return $this->servicePriceType();
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function billingCycle()
    {
        return $this->belongsTo(BillingCycle::class);
    }

    public function businessServicePrices() {
        return $this->hasMany(BusinessServicePrice::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
