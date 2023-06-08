<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReference extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = 
    [
        'customer_reference_type_id',
        'name',
        'identification_document',
        'phone',
        'email',
        'address',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'type',
    ];

    public function customerReferenceType() {
        return $this->belongsTo(CustomerReferenceType::class);
    }

    public function type () {
        return $this->customerReferenceType();
    }
}
