<?php

namespace App\Models\Sale;

use App\Models\Product\MeasurementUnit;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
use App\Models\Product\ProductDetailPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'product_detail_price_id',
        'measurement_unit_id',
        'quantity',
        'discount',
        'code',
        'name',
        'taxed',
        'tax',
        'percentage_taxed',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'productDetail',
        'measurementUnit',
        'price'
    ];
    
    public function productDetail() {
        return $this->hasOneThrough(ProductDetail::class, ProductDetailPrice::class, 'id', 'id', 'product_detail_price_id', 'product_detail_id');
    }

    public function measurementUnit() {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function productDetailPrice() {
        return $this->belongsTo(ProductDetailPrice::class);
    }

    public function price() {
        return $this->productDetailPrice();
    }
}
