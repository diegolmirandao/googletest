<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
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
        'has_amount_equivalencies'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'subcategories',
        'options',
    ];

    public function subcategories() {
        return $this->belongsToMany(ProductSubcategory::class, 'variant_subcategory');
    }

    public function variantOptions() {
        return $this->hasMany(VariantOption::class);
    }

    public function options() {
        return $this->variantOptions();
    }
}
