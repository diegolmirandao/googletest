<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
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
        'equivalent_variant_option_id',
        'equivalent_amount'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'equivalentOption',
    ];

    public function equivalentVariantOption() {
        return $this->belongsTo(VariantOption::class, 'equivalent_variant_option_id');
    }

    public function equivalentOption() {
        return $this->equivalentVariantOption();
    }
}
