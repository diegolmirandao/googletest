<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synchronizable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'device_id',
    ];

    public function synchronizable() {
        return $this->morphTo();
    }

    public function device() {
        return $this->belongsTo(Device::class);
    }

    public function scopeOfDevice($query, $id) {
        return $query->where('device_id', $id);
    }
}
