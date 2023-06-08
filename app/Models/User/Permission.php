<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use HasFactory;

    protected $with = [
        'permissionGroup',
    ];

    protected $appends = [
        'description'
    ];

    public function permissionGroup() {
        return $this->belongsTo(PermissionGroup::class);
    }

    public function getDescriptionAttribute() {
        $description = __('permissions.'.$this->name);
        if ($description == 'permissions.'.$this->name) {
            if (explode('.', $this->name)[0] == 'service_price_type') {
                $servicePriceTypeId = array_values(array_slice(explode('_', $this->name), -1))[0];
                $description = __('permissions.service_price_type.sell_price_type').$servicePriceTypeId;
            }
        }
        return $description;
    }
}
