<?php

namespace App\Models\Staff\Business;

use App\Scopes\Staff\BusinessScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CreatedUpdatedBy;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Staff\Bill\Bill;
use App\Models\User\User;
use App\Models\Tenant;

class Business extends Model
{
    use HasFactory, SoftDeletes, CreatedUpdatedBy, EagerLoadPivotTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'name',
        'sub_domain',
        'status',
        'customer_name',
        'phone',
        'email',
        'confirmed_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'tenant_id',
        'sub_domain',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'services',
        'features',
        'createdBy',
        'updatedBy'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new BusinessScope);
    }
 
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function services()
    {
        return $this->businessServicePrices();
    }

    public function features()
    {
        return $this->businessFeatures();
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function businessServicePrices()
    {
        return $this->hasMany(BusinessServicePrice::class);
    }

    public function businessFeatures()
    {
        return $this->hasMany(BusinessFeature::class);
    }

    public function getTrialEndsAtAttribute()
    {
        return NULL;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function businessUsers()
    {
        return $this->hasMany(BusinessUser::class);
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
