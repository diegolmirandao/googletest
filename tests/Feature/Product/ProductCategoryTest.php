<?php

use App\Models\Product\ProductCategory;
use App\Models\Tenant;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\User\Permission;

beforeEach(function () {
    $this->tenant = Tenant::create();
    tenancy()->initialize($this->tenant);

    $this->superAdminUser = User::factory()->hasAttached(Role::find(1))->create()->givePermissionTo(Permission::all());
});

afterEach(function () {
    tenancy()->delete($this->tenant);
});

/* Datasets */

dataset('product_category_store_validation_fail', [
    'Required fields' => [
        ['name' => ''],
    ],
    'Unique fields' => [
        fn() => ['name' => ProductCategory::factory()->create()->name],
    ],
    'Exists fields' => [
    ]
]);

dataset('product_category_store_validation_pass', [
    'Valid fields' => [
        [
            'name' => 'name',
        ],
    ],
]);

dataset('product_category_update_validation_fail', [
    'Required fields' => [
        ['name' => ''],
    ],
    'Unique fields' => [
        fn() => ['username' => User::factory()->create()->name],
    ],
    'Exists fields' => [
    ]
]);

dataset('product_category_update_validation_pass', [
    'Valid fields' => [
        [
            'name' => 'name',
        ],
    ],
]);

/* Basic Tests */

test('index', function () {
    $response = actingAs($this->superAdminUser)->getJson(route('product-categories.index'));

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);
});

test('store', function () {
    $response = actingAs($this->superAdminUser)->postJson(route('product-categories.store'), $this->userPayload);

    $response->assertCreated()
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);
    $this->assertDatabaseHas('users', [
        'email' => $this->userPayload['email']
    ]);
});

test('show', function () {
    $response = actingAs($this->superAdminUser)->getJson(route('product-categories.show', $this->superAdminUser->id));

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);
});

test('update', function () {
    $response = actingAs($this->superAdminUser)->putJson(route('product-categories.update', $this->superAdminUser->id), ['name' => 'new name']);

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);
    $this->assertDatabaseHas('users', [
        'email' => $this->userPayload['email']
    ]);
});

test('destroy', function () {
    $user = User::factory()->hasAttached(Role::find(1))->create();

    $response = actingAs($this->superAdminUser)->deleteJson(route('product-categories.destroy', $user->id));

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'created_at',
                'updated_at',
            ]);
    $this->assertModelMissing($user);
});


/* Validation Tests */

test('product_category_store_validation_fail', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->postJson(route('product-categories.store'), $validationPayload);

    $response->assertUnprocessable()
            ->assertJsonValidationErrors(array_keys($validationPayload));
})->with('product_category_store_validation_fail');

test('product_category_store_validation_pass', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->postJson(route('product-categories.store'), $validationPayload);

    $response->assertCreated()
            ->assertJsonMissingValidationErrors(array_keys($validationPayload));
})->with('product_category_store_validation_pass');

test('product_category_update_validation_fail', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->putJson(route('product-categories.update', $this->superAdminUser->id), $validationPayload);

    $response->assertUnprocessable()
            ->assertJsonValidationErrors(array_keys($validationPayload));
})->with('product_category_update_validation_fail');

test('product_category_update_validation_pass', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->putJson(route('product-categories.update', $this->superAdminUser->id), $validationPayload);

    $response->assertOk()
            ->assertJsonMissingValidationErrors(array_keys($validationPayload));
})->with('product_category_update_validation_pass');


/* Permission Tests */

test('cannot_access_index', function ($user) {
    $response = actingAs($user)->getJson(route('product-categories.index'));

    $response->assertForbidden();
})->with('user_without_permissions');

test('cannot_access_product_category_store', function ($user) {
    $response = actingAs($user)->postJson(route('product-categories.store'));

    $response->assertForbidden();
})->with('user_without_permissions');

test('cannot_access_show', function ($user) {
    $response = actingAs($user)->getJson(route('product-categories.show', $user->id));

    $response->assertForbidden();
})->with('user_without_permissions');

test('cannot_access_product_category_update', function ($user) {
    $response = actingAs($user)->putJson(route('product-categories.update', $user->id));

    $response->assertForbidden();
})->with('user_without_permissions');

test('cannot_access_destroy', function ($user) {
    $response = actingAs($user)->deleteJson(route('product-categories.destroy', $user->id));

    $response->assertForbidden();
})->with('user_without_permissions');
