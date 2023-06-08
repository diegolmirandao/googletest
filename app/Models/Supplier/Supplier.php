<?php

namespace App\Models\Supplier;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Models\Device;
use App\Traits\HasSync;

class Supplier extends Model
{
    use HasFactory, HasSync, Filterable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = 
    [
        'name',
        'identification_document',
        'email',
        'address',
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
        'contacts',
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
        'phones.phone',
        'email',
        'address',
        'created_at',
        'updated_at',
    ];

    public function getPhonesAttribute() {
        return $this->phones()->get()->map(fn($phone) => $phone->phone);
    }

    public function phones() {
        return $this->morphMany(Phone::class, 'phonable');
    }

    public function supplierContacts() {
        return $this->hasMany(SupplierContact::class);
    }

    public function contacts() {
        return $this->supplierContacts();
    }

    public function supplierAddresses() {
        return $this->hasMany(SupplierAddress::class);
    }

    public function addresses() {
        return $this->supplierAddresses();
    }
}
