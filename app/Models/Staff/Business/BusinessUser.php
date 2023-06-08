<?php

namespace App\Models\Staff\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\CreatedUpdatedBy;

class BusinessUser extends Pivot
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'createdBy',
        'updatedBy'
    ];

    public function scopeUser($query, $id)
    {
        return $query->where('user_id', $id);
    }
}
