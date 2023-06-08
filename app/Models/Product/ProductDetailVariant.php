<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetailVariant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'variant_option_id',
        'product_detail_id',
    ];

    /**
     * The attributes to be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'name'
    ];

    public function getNameAttribute() {
        return $this->variant->name;
    }

    public function variant() {
        return $this->hasOneThrough(
            Variant::class,
            VariantOption::class,
            'id',
            'id',
            'variant_option_id',
            'variant_id'
        );
    }

    public function variantOption() {
        return $this->belongsTo(VariantOption::class);
    }

    public function option() {
        return $this->variantOption();
    }
}
