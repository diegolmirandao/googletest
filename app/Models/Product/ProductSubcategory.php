<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'name'
    ];

    public function productCategory() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function category() {
        return $this->productCategory();
    }
}
