<?php

namespace App\Models\Staff\Feature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'group',
    ];

    public function featureGroup()
    {
        return $this->belongsTo(FeatureGroup::class);
    }

    public function group()
    {
        return $this->featureGroup();
    }
}
