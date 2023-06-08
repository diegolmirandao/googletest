<?php

namespace App\Models\Purchase;

use App\Models\Product\MeasurementUnit;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
use App\Models\Product\ProductDetailCost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'product_detail_cost_id',
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
        'cost'
    ];
    
    public function productDetail() {
        return $this->hasOneThrough(ProductDetail::class, ProductDetailCost::class, 'id', 'id', 'product_detail_cost_id', 'product_detail_id');
    }

    public function measurementUnit() {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function productDetailCost() {
        return $this->belongsTo(ProductDetailCost::class);
    }

    public function cost() {
        return $this->productDetailCost();
    }
}
