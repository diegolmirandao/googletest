<?php

namespace App\Models\Supplier;

use App\Models\Location\City;
use App\Models\Location\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAddress extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = 
    [
        'zone_id',
        'name',
        'phone',
        'address',
        'reference',
        'lat',
        'lng',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'city',
        'zone'
    ];

    public function city() {
        return $this->hasOneThrough(
            City::class,
            Zone::class,
            'id',
            'id',
            'zone_id',
            'city_id'
        );
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }
}
