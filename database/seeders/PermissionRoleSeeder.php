<?php

namespace Database\Seeders;

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
        // Permisos de Empresas

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
        ];

        Permission::upsert($businessPermissions, 'name');

        // Permisos de Empresas

        $establishmentPermissions = [
            [
                'name' => 'establishment.view',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'establishment.create',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'establishment.update',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'establishment.delete',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($establishmentPermissions, 'name');

        // Permisos de Categorías de productos

        $pointOfSalePermissions = [
            [
                'name' => 'point_of_sale.create',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'point_of_sale.update',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'point_of_sale.delete',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($pointOfSalePermissions, 'name');

        // Permisos de Depositos

        $warehousePermissions = [
            [
                'name' => 'warehouse.view',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'warehouse.create',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'warehouse.update',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'warehouse.delete',
                'permission_group_id' => 1,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($warehousePermissions, 'name');

        // Permisos de Monedas

        $currencyPermissions = [
            [
                'name' => 'currency.view',
                'permission_group_id' => 2,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'currency.create',
                'permission_group_id' => 2,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'currency.update',
                'permission_group_id' => 2,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'currency.delete',
                'permission_group_id' => 2,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($currencyPermissions, 'name');

        // Permisos de Usuario

        $userPermissions = [
            [
                'name' => 'user.view',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'user.create',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'user.update',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'user.delete',
                'permission_group_id' => 3,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($userPermissions, 'name');

        // Permisos de Productos

        $productPermissions = [
            [
                'name' => 'product.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($productPermissions, 'name');

        // Permisos de Categorías de productos

        $productCategoryPermissions = [
            [
                'name' => 'product_category.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_category.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_category.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_category.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($productCategoryPermissions, 'name');

        // Permisos de Categorías de productos

        $productSubcategoryPermissions = [
            [
                'name' => 'product_subcategory.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_subcategory.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_subcategory.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($productSubcategoryPermissions, 'name');

        // Permisos de Marcas

        $brandPermissions = [
            [
                'name' => 'brand.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'brand.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'brand.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'brand.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($brandPermissions, 'name');

        // Permisos de Unidades de medidas

        $measurementUnitPermissions = [
            [
                'name' => 'measurement_unit.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'measurement_unit.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'measurement_unit.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'measurement_unit.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($measurementUnitPermissions, 'name');

        // Permisos de variantes

        $variantPermissions = [
            [
                'name' => 'variant.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant_option.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant_option.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant_option.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($variantPermissions, 'name');

        // Permisos de Propiedades

        $propertyPermissions = [
            [
                'name' => 'property.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'property.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'property.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'property_option.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'property_option.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'property_option.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'variant.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($propertyPermissions, 'name');

        // Permisos de tipos de precios

        $priceTypePermissions = [
            [
                'name' => 'product_price_type.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_price_type.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_price_type.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_price_type.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($priceTypePermissions, 'name');

        // Permisos de tipos de costos

        $costTypePermissions = [
            [
                'name' => 'product_cost_type.view',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_cost_type.create',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_cost_type.update',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'product_cost_type.delete',
                'permission_group_id' => 4,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($costTypePermissions, 'name');

        // Permisos de categorías de clientes

        $customerCategoryPermissions = [
            [
                'name' => 'customer_category.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer_category.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer_category.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer_category.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($customerCategoryPermissions, 'name');

        // Permisos de canal de adquisición

        $acquisitionChannelPermissions = [
            [
                'name' => 'acquisition_channel.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'acquisition_channel.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'acquisition_channel.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'acquisition_channel.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($acquisitionChannelPermissions, 'name');

        // Permisos de tipos de referencias de clientes

        $customerReferenceTypePermissions = [
            [
                'name' => 'customer_reference_type.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer_reference_type.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer_reference_type.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer_reference_type.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($customerReferenceTypePermissions, 'name');

        // Permisos de clientes

        $customerPermissions = [
            [
                'name' => 'customer.view',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer.create',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer.update',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'customer.delete',
                'permission_group_id' => 5,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($customerPermissions, 'name');

        // Permisos de ventas

        $salePermissions = [
            [
                'name' => 'sale.view',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale.create',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale.update',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_product.view',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_product.create',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_product.update',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_product.delete',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_payment.view',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_payment.create',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_payment.update',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_payment.delete',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale.delete',
                'permission_group_id' => 6,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($salePermissions, 'name');

        // Permisos de proveedores

        $supplierPermissions = [
            [
                'name' => 'supplier.view',
                'permission_group_id' => 7,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'supplier.create',
                'permission_group_id' => 7,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'supplier.update',
                'permission_group_id' => 7,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'supplier.delete',
                'permission_group_id' => 7,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($supplierPermissions, 'name');

        // Permisos de compras

        $purchasePermissions = [
            [
                'name' => 'purchase.view',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase.create',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase.update',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_product.view',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_product.create',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_product.update',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_product.delete',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_payment.view',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_payment.create',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_payment.update',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase_payment.delete',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'purchase.delete',
                'permission_group_id' => 8,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($purchasePermissions, 'name');

        // Permisos de ventas

        $saleOrderPermissions = [
            [
                'name' => 'sale_order.view',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_order.create',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_order.update',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_order_product.view',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_order_product.create',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_order_product.update',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale_order_product.delete',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
            [
                'name' => 'sale.delete',
                'permission_group_id' => 9,
                'guard_name' => 'sanctum',
            ],
        ];

        Permission::upsert($saleOrderPermissions, 'name');


        // Asignación de Permisos por Rol

        $warehousePermissionGroup = Permission::where('permission_group_id', 1)->get()->pluck('id');
        $currencyPermissionGroup = Permission::where('permission_group_id', 2)->get()->pluck('id');
        $userPermissionGroup = Permission::where('permission_group_id', 3)->get()->pluck('id');
        $productPermissionGroup = Permission::where('permission_group_id', 4)->get()->pluck('id');
        $customerPermissionGroup = Permission::where('permission_group_id', 5)->get()->pluck('id');
        $salePermissionGroup = Permission::where('permission_group_id', 6)->get()->pluck('id');
        $supplierPermissionGroup = Permission::where('permission_group_id', 7)->get()->pluck('id');
        $purchasePermissionGroup = Permission::where('permission_group_id', 8)->get()->pluck('id');
        $saleOrderPermissionGroup = Permission::where('permission_group_id', 9)->get()->pluck('id');

        // Rol SUPER ADMINISTRADOR

        $superAdminRole = Role::find(1);

        $superAdminRole->givePermissionTo($warehousePermissionGroup);
        $superAdminRole->givePermissionTo($currencyPermissionGroup);
        $superAdminRole->givePermissionTo($userPermissionGroup);
        $superAdminRole->givePermissionTo($productPermissionGroup);
        $superAdminRole->givePermissionTo($customerPermissionGroup);
        $superAdminRole->givePermissionTo($salePermissionGroup);
        $superAdminRole->givePermissionTo($supplierPermissionGroup);
        $superAdminRole->givePermissionTo($purchasePermissionGroup);
        $superAdminRole->givePermissionTo($saleOrderPermissionGroup);
        
        // Rol ADMINISTRADOR

        $adminRole = Role::find(2);

        $adminRole->givePermissionTo($userPermissionGroup);
        $adminRole->givePermissionTo($productPermissionGroup);
        $adminRole->givePermissionTo($customerPermissionGroup);
        $adminRole->givePermissionTo($salePermissionGroup);
        $adminRole->givePermissionTo($supplierPermissionGroup);
        $adminRole->givePermissionTo($purchasePermissionGroup);
        $adminRole->givePermissionTo($saleOrderPermissionGroup);

        // Asignación de permisos por defecto a usuario SUPER ADMINISTRADOR

        $superAdmin = User::find(1);

        $superAdmin->givePermissionTo($warehousePermissionGroup);
        $superAdmin->givePermissionTo($currencyPermissionGroup);
        $superAdmin->givePermissionTo($userPermissionGroup);
        $superAdmin->givePermissionTo($productPermissionGroup);
        $superAdmin->givePermissionTo($customerPermissionGroup);
        $superAdmin->givePermissionTo($salePermissionGroup);
        $superAdmin->givePermissionTo($supplierPermissionGroup);
        $superAdmin->givePermissionTo($purchasePermissionGroup);
        $superAdmin->givePermissionTo($saleOrderPermissionGroup);
    }
}
