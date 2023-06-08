<?php

namespace App\Models\Staff\Feature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureGroup extends Model
{
    use HasFactory;

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
