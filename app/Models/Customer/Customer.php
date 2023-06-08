<?php

namespace App\Models\Customer;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Models\Device;
use App\Traits\HasSync;

class Customer extends Model
{
    use HasFactory, HasSync, Filterable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = 
    [
        'customer_category_id',
        'acquisition_channel_id',
        'name',
        'identification_document',
        'email',
        'birthday',
        'address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'datetime',
    ];

    /**
     * The attributes to be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'phones'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'category',
        'acquisitionChannel',
        'billingAddresses',
        'references',
        'addresses',
    ];

    /**
     * Fields that can be filtered
     *
     * @var array
     */
    private static $whiteListFilter = [
        'name',
        'identification_document',
        'customer_category_id',
        'acquisition_channel_id',
        'phones.phone',
        'email',
        'birthday',
        'address',
        'created_at',
        'updated_at',
    ];

    public function getPhonesAttribute() {
        return $this->phones()->get()->map(fn($phone) => $phone->phone);
    }

    public function customerCategory() {
        return $this->belongsTo(CustomerCategory::class);
    }

    public function category() {
        return $this->customerCategory();
    }

    public function acquisitionChannel() {
        return $this->belongsTo(AcquisitionChannel::class);
    }

    public function phones() {
        return $this->morphMany(Phone::class, 'phonable');
    }

    public function customerBillingAddresses() {
        return $this->hasMany(CustomerBillingAddress::class);
    }

    public function billingAddresses() {
        return $this->customerBillingAddresses();
    }

    public function customerReferences() {
        return $this->hasMany(CustomerReference::class);
    }

    public function references() {
        return $this->customerReferences();
    }

    public function customerAddresses() {
        return $this->hasMany(CustomerAddress::class);
    }

    public function addresses() {
        return $this->customerAddresses();
    }
}
