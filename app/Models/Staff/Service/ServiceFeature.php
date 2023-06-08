<?php

namespace App\Models\Staff\Service;

use App\Models\Staff\Feature\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;

class ServiceFeature extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'feature_id',
        'quantity',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'feature',
        'createdBy',
        'updatedBy'
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
