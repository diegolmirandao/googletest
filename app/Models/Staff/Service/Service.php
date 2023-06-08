<?php

namespace App\Models\Staff\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Staff\Bill\BillService;
use App\Models\Staff\Business\BusinessServicePrice;

class Service extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy, EagerLoadPivotTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status',
        'comments',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'prices',
        'features',
        'createdBy',
        'updatedBy'
    ];

    public function prices() {
        return $this->servicePrices();
    }

    public function features() {
        return $this->serviceFeatures();
    }

    public function servicePrices() {
        return $this->hasMany(ServicePrice::class);
    }
    
    public function serviceFeatures() {
        return $this->hasMany(ServiceFeature::class);
    }

    public function businessServicePrices() {
        return $this->hasManyThrough(BusinessServicePrice::class, ServicePrice::class);
    }

    public function billServices() {
        return $this->belongsToMany(BillService::class);
    }

    public function syncFeatures($features)
    {
        $featuresCollection = collect($features)->unique('feature_id');
        $featuresIds = $featuresCollection->pluck('feature_id')->all();
        $this->features()->whereNotIn('feature_id', $featuresIds)->delete();
        $currentFeaturesIds = $this->features()->get()->pluck('feature_id');
        $newFeatures = $featuresCollection->whereNotIn('feature_id', $currentFeaturesIds)->all();
        $this->features()->createMany($newFeatures);
        $updatedFeatures = $featuresCollection->whereIn('feature_id', $currentFeaturesIds)->all();
        foreach ($updatedFeatures as $updatedFeature) {
            $this->features()->where('feature_id', $updatedFeature['feature_id'])->update($updatedFeature);
        }
    }
}
