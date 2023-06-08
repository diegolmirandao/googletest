<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'name',
        'type',
        'measurement_unit_id',
        'has_multiple_values',
        'is_required'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'measurementUnit',
        'subcategories',
        'options',
    ];

    public function measurementUnit() {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function subcategories() {
        return $this->belongsToMany(ProductSubcategory::class, 'property_subcategory');
    }

    public function propertyOptions() {
        return $this->hasMany(PropertyOption::class);
    }

    public function options() {
        return $this->propertyOptions();
    }
}
