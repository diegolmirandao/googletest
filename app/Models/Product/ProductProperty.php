<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'property_id',
        'property_option_id',
        'value'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'property',
        'option'
    ];

    public function property () {
        return $this->belongsTo(Property::class);
    }

    public function propertyOption () {
        return $this->belongsTo(PropertyOption::class);
    }

    public function option () {
        return $this->propertyOption();
    }
}
