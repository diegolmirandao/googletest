<?php

namespace Database\Seeders\Staff;

use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisos de Empresa

        $businessPermissions = [
            [
                'name' => 'business.view',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business.create',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business.update',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business.delete',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business.activate',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business.assign',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($businessPermissions, 'name');

        // Permisos de Servicios de Empresa

        $businessServicePermissions = [
            [
                'name' => 'business_service.view',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_service.create',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_service.update',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_service.delete',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_service.activate',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_service.suspend',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_service.cancel',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($businessServicePermissions, 'name');

        // Permisos de Funcionalidades de Empresa

        $businessFeaturePermissions = [
            [
                'name' => 'business_feature.view',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'business_feature.update',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($businessFeaturePermissions, 'name');

        // Permisos de Facturación

        $billPermissions = [
            [
                'name' => 'bill.view',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill.create',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill.update',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill.delete',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill.cancel',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_service.create',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_service.update',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_service.delete',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_payment.create',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_payment.update',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_payment.delete',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'bill_payment.cancel',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($billPermissions, 'name');

        // Permisos de Ticket

        $ticketPermissions = [
            [
                'name' => 'ticket.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'ticket.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'ticket.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'ticket.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'ticket_reply.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'ticket_reply.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'ticket_reply.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($ticketPermissions, 'name');

        // Permisos de Servicio

        $servicePermissions = [
            [
                'name' => 'service.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($servicePermissions, 'name');

        // Permisos de Usuario

        $userPermissions = [
            [
                'name' => 'user.view',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'user.create',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'user.update',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'user.delete',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($userPermissions, 'name');

        // Permisos de Permiso

        $permissionPermissions = [
            [
                'name' => 'permission.view',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'permission.create',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'permission.update',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'permission.delete',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($permissionPermissions, 'name');

        // Permisos de Roles

        $rolePermissions = [
            [
                'name' => 'role.view',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'role.create',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'role.update',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'role.delete',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($rolePermissions, 'name');

        // Permisos de Precio de Servicios

        $servicePricePermissions = [
            [
                'name' => 'service_price.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($servicePricePermissions, 'name');

        // Permisos de Tipos de Precio de Servicios

        $servicePriceTypePermissions = [
            [
                'name' => 'service_price_type.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price_type.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price_type.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price_type.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price_type.sell_price_type_1',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_price_type.sell_price_type_2',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($servicePriceTypePermissions, 'name');

        // Permisos de Funcionalidades de Servicios

        $serviceFeaturePermissions = [
            [
                'name' => 'service_feature.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'service_feature.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($serviceFeaturePermissions, 'name');

        // Asignación de Permisos por Rol

        $businessPermissionGroup = Permission::where('permission_group_id', 1)->get()->pluck('id');
        $billPermissionGroup = Permission::where('permission_group_id', 3)->get()->pluck('id');
        $ticketPermissionGroup = Permission::where('permission_group_id', 4)->get()->pluck('id');
        $servicePermissionGroup = Permission::where('permission_group_id', 5)->get()->pluck('id');
        $userPermissionGroup = Permission::where('permission_group_id', 6)->get()->pluck('id');
        $rolePermissionGroup = Permission::where('permission_group_id', 8)->get()->pluck('id');
        $featurePermissions = Permission::where('permission_group_id', 5)->get()->pluck('id');

        // Rol SUPER ADMINISTRADOR

        $superAdminRole = Role::find(1);

        $superAdminRole->givePermissionTo($businessPermissionGroup);
        $superAdminRole->givePermissionTo($billPermissionGroup);
        $superAdminRole->givePermissionTo($ticketPermissionGroup);
        $superAdminRole->givePermissionTo($servicePermissionGroup);
        $superAdminRole->givePermissionTo($userPermissionGroup);
        $superAdminRole->givePermissionTo($rolePermissionGroup);
        $superAdminRole->givePermissionTo($featurePermissions);
        
        // Rol ADMINISTRADOR

        $adminRole = Role::find(2);

        $adminRole->givePermissionTo($businessPermissionGroup);
        $adminRole->givePermissionTo($billPermissionGroup);
        $adminRole->givePermissionTo($ticketPermissionGroup);
        $adminRole->givePermissionTo($servicePermissionGroup);
        $adminRole->givePermissionTo($userPermissionGroup);
        $adminRole->givePermissionTo($rolePermissionGroup);
        $adminRole->givePermissionTo($featurePermissions);

        // Rol ASESOR

        $asesorRole = Role::find(3);

        $asesorRole->givePermissionTo($businessPermissionGroup);
        $asesorRole->givePermissionTo($ticketPermissionGroup);

        // Asignación de permisos por defecto a usuario SUPER ADMINISTRADOR

        $superAdmin = User::find(1);

        $superAdmin->givePermissionTo($businessPermissionGroup);
        $superAdmin->givePermissionTo($billPermissionGroup);
        $superAdmin->givePermissionTo($ticketPermissionGroup);
        $superAdmin->givePermissionTo($servicePermissionGroup);
        $superAdmin->givePermissionTo($userPermissionGroup);
        $superAdmin->givePermissionTo($rolePermissionGroup);
        $superAdmin->givePermissionTo($featurePermissions);
    }
}
