<?php

namespace App\Models\Product;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetailStock extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'warehouse',
    ];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
