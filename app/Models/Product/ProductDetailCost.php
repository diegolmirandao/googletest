<?php

namespace App\Models\Product;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetailCost extends Model
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
        'cost_type_id',
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

    public function productCostType() {
        return $this->belongsTo(ProductCostType::class, 'cost_type_id');
    }

    public function type() {
        return $this->productCostType();
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
