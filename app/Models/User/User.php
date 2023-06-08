<?php

namespace App\Models\User;

use App\Models\Staff\Business\Business;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use App\Models\Device;
use App\Traits\HasSync;
use Illuminate\Support\Facades\Cookie;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Filterable, HasSync;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'status',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'roles',
        'permissions',
    ];

    // /**
    //  * The attributes to be appended to the model.
    //  *
    //  * @var array
    //  */
    protected $appends = [
        'role_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Fields that can be filtered
     *
     * @var array
     */
    private static $whiteListFilter = [
        'name',
        'username',
        'email',
        'status',
        'roles.id',
        'roles.id.value',
        'roles.id.operator',
        'created_at',
    ];

    protected $guard_name = "sanctum";

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function businesses() {
        return $this->belongsToMany(Business::class);
    }

    public function devicesConnectedTo() {
        return $this->hasMany(Device::class, 'connected_user');
    }

    public function device() {
        return $this->devicesConnectedTo()->where('id', Cookie::get('Device-Id'))->first();
    }

    public function getRoleIdAttribute() {
        return $this->roles->first()->id;
    }
}
