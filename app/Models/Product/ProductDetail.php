<?php

namespace App\Models\Product;

use App\Models\Image;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'status',
    ];

    /**
     * The attributes to be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'name',
        'codes'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'product',
        'costs',
        'prices',
        'stock',
        'variants',
        'variants.option',
        'descriptions',
        'images'
    ];

    public function getNameAttribute() {
        $name = $this->product->name;
        foreach($this->variants as $variant) {
            $name .= ' ' . $variant->option->name;
        }
        return $name;
    }

    public function getCodesAttribute() {
        return $this->codes()->get()->map(fn($code) => $code->code);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function productDetailPrices() {
        return $this->hasMany(ProductDetailPrice::class);
    }

    public function prices() {
        return $this->productDetailPrices();
    }

    public function productDetailCosts() {
        return $this->hasMany(ProductDetailCost::class);
    }

    public function costs() {
        return $this->productDetailCosts();
    }

    public function productDetailStocks() {
        return $this->hasMany(ProductDetailStock::class);
    }

    public function stock() {
        return $this->productDetailStocks();
    }

    public function productDetailVariants() {
        return $this->hasMany(ProductDetailVariant::class);
    }

    public function variants() {
        return $this->productDetailVariants();
    }

    public function codes() {
        return $this->morphMany(Code::class, 'codable');
    }

    public function descriptions() {
        return $this->morphMany(Description::class, 'describable');
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
