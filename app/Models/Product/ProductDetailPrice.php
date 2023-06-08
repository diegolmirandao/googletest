<?php

namespace App\Models\Product;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetailPrice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'currency_id',
        'price_type_id',
        'amount'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'type',
        'currency'
    ];

    public function productPriceType() {
        return $this->belongsTo(ProductPriceType::class, 'price_type_id');
    }

    public function type() {
        return $this->productPriceType();
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
