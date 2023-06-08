<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    public function products() {
        return $this->morphedByMany(Product::class, 'parameterable');
    }

    public function parameterGroup() {
        return $this->belongsTo(ParameterGroup::class);
    }

    public function group() {
        return $this->parameterGroup();
    }
}
