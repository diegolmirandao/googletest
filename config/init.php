<?php
    return [
        'models' => [
            'user' => App\Models\User\User::class,
            'role' => App\Models\User\Role::class,
            'currency' => App\Models\Currency::class,
            'business' => App\Models\Business::class,
            'establishment' => App\Models\Establishment::class,
            'warehouse' => App\Models\Warehouse::class,
            'country' => App\Models\Location\Country::class,
            'customerCategory' => App\Models\Customer\CustomerCategory::class,
            'acquisitionChannel' => App\Models\Customer\AcquisitionChannel::class,
            'customerReferenceType' => App\Models\Customer\CustomerReferenceType::class,
            'productCategory' => App\Models\Product\ProductCategory::class,
            'brand' => App\Models\Product\Brand::class,
            'measurementUnit' => App\Models\Product\MeasurementUnit::class,
            'productType' => App\Models\Product\ProductType::class,
            'productPriceType' => App\Models\Product\ProductPriceType::class,
            'productCostType' => App\Models\Product\ProductCostType::class,
            'property' => App\Models\Product\Property::class,
            'variant' => App\Models\Product\Variant::class,
            'paymentTerm' => App\Models\PaymentTerm::class,
            'paymentMethod' => App\Models\PaymentMethod::class,
            'documentType' => App\Models\DocumentType::class,
            'saleOrderStatus' => App\Models\SaleOrder\SaleOrderStatus::class
        ]
    ];