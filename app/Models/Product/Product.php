<?php

namespace App\Models\Product;

use App\Models\Image;
use App\Models\Parameter;
use App\Traits\CreatedUpdatedBy;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'subcategory_id',
        'brand_id',
        'type_id',
        'measurement_unit_id',
        'name',
        'description',
        'status',
        'taxed',
        'tax',
        'percentage_taxed'
    ];

    /**
     * The attributes to be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'codes',
        'properties'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'category',
        'subcategory',
        'brand',
        'type',
        'measurementUnit',
        'descriptions',
        // 'details',
        'images',
        'parameters'
    ];

    /**
     * Fields that can be filtered
     *
     * @var array
     */
    private static $whiteListFilter = [
        'subcategory_id',
        'brand_id',
        'type_id',
        'measurement_unit_id',
        'name',
        'description',
        'status',
        'taxed',
        'tax',
        'percentage_taxed',
        'created_at',
        'updated_at',
    ];

    public function getCodesAttribute() {
        return $this->codes()->get()->map(fn($code) => $code->code);
    }

    public function getPropertiesAttribute() {
        $properties = $this->properties()->get()->groupBy('property_id')->map(fn($properties) => [
            'property_id' => $properties[0]->property_id,
            'name' => $properties[0]->property->name,
            'value' => $properties[0]->property_option_id ? ($properties[0]->property->has_multiple_values ? $properties->map(fn($property) => $property->option->value) : $properties->map(fn($property) => $property->option->value)->first()) : $properties[0]->value
        ])->values();
        
        return $properties;
    }

    public function productSubcategory() {
        return $this->belongsTo(ProductSubcategory::class, 'subcategory_id');
    }

    public function subcategory() {
        return $this->productSubcategory();
    }

    public function category() {
        return $this->hasOneThrough(
            ProductCategory::class,
            ProductSubcategory::class,
            'id',
            'id',
            'subcategory_id',
            'product_category_id'
        );
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function productType() {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function type() {
        return $this->productType();
    }

    public function measurementUnit() {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function codes() {
        return $this->morphMany(Code::class, 'codable');
    }

    public function descriptions() {
        return $this->morphMany(Description::class, 'describable');
    }

    public function properties() {
        return $this->hasMany(ProductProperty::class);
    }

    public function productDetails() {
        return $this->hasMany(ProductDetail::class);
    }

    public function details() {
        return $this->productDetails();
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function parameters() {
        return $this->morphToMany(Parameter::class, 'parameterable');
    }
}
