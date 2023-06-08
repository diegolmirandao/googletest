<?php

namespace App\Models\Staff\Bill;

use App\Models\Staff\Business\BusinessServicePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;

class BillService extends Model
{
    use SoftDeletes, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_service_price_id',
        'quantity',
        'description',
        'covers_from',
        'covers_to',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'businessServicePrice',
        'businessServicePrice.servicePrice.service',
        'createdBy',
        'updatedBy'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'covers_from' => 'datetime',
        'covers_to' => 'datetime',
    ];
    
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function businessServicePrice()
    {
        return $this->belongsTo(BusinessServicePrice::class);
    }

    public function setDescription()
    {
        $this->description = $this->businessServicePrice->servicePrice->service->name;
    }

    public function setCoversFrom()
    {
        $this->covers_from = $this->businessServicePrice->last_expiration_at ?? $this->businessServicePrice->activated_at;
    }

    public function setCoversTo()
    {
        $this->covers_to = $this->businessServicePrice->next_expiration_at;
    }
}
