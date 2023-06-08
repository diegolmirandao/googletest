<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Currency extends Model
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
}
