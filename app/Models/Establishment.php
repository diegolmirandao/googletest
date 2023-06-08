<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'business_id',
        'name',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'business',
        'pointsOfSale',
    ];

    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function pointsOfSale() {
        return $this->hasMany(PointOfSale::class);
    }
}
