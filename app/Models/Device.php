<?php

namespace App\Models;

use App\Models\Customer\Customer;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Device extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = 
    [
        'name',
        'has_offline',
        'connected',
        'connected_user',
        'last_connection',
        'last_connected_user',
    ];

    public function connectedUser() {
        return $this->belongsTo(User::class, 'connected_user');
    }

    public function lastConnectedUser() {
        return $this->belongsTo(User::class, 'last_connected_user');
    }

    public function connect() {
        $this->connected = true;
    }

    public function disconnect() {
        $this->connected = false;
    }

    public function setConnected($userId) {
        $this->connected_user = $userId;
    }

    public function setLastConnected($userId) {
        $this->last_connected_user = $userId;
    }

    public function setLastConnection() {
        $this->last_connection = Carbon::now();
    }

    public function scopeActive($query) {
        return $query->where('connected', 1);
    }

    public function scopeExcludeDevice($query, $deviceId) {
        return $query->where('id', '!=', $deviceId);
    }

    public function users() {
        return $this->morphedByMany(User::class, 'synchronizable');
    }

    public function customers() {
        return $this->morphedByMany(Customer::class, 'synchronizable');
    }
}
