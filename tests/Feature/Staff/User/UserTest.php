<?php

use App\Models\User\User;
use App\Models\User\Role;
use App\Models\User\Permission;

beforeEach(function () {
    $this->superAdminUser = User::factory()->hasAttached(Role::find(1))->create()->givePermissionTo(Permission::all());
    $this->userPayload = User::factory()->raw([
        'role_id' => 1,
        'permissions' => [1, 2, 3]
    ]);
});

/* Datasets */

dataset('store_validation_fail', [
    'Required fields' => [
        ['name' => ''],
        ['username' => ''],
        ['email' => ''],
        ['password' => ''],
        ['status' => null],
        ['role_id' => null],
        ['permissions' => []],
    ],
    'Unique fields' => [
        fn() => ['username' => $this->superAdminUser->username],
        fn() => ['email' => $this->superAdminUser->email]
    ],
    'Exists fields' => [
        fn() => ['role_id' => Role::get()->last()->id + 1]
    ]
]);

dataset('store_validation_pass', [
    'Valid fields' => [
        [
            'name' => 'name',
            'username' => 'username',
            'email' => 'email@mail.com',
            'password' => 'password',
            'status' => 1,
            'role_id' => 1,
            'permissions' => [1,2,3]
        ],
    ],
]);

dataset('update_validation_fail', [
    'Required fields' => [
        ['name' => ''],
        ['username' => ''],
        ['email' => ''],
        ['role_id' => null],
        ['permissions' => []],
    ],
    'Unique fields' => [
        fn() => ['username' => User::factory()->create()->username],
        fn() => ['email' => User::factory()->create()->email]
    ],
    'Exists fields' => [
        fn() => ['role_id' => Role::get()->last()->id + 1]
    ]
]);

dataset('update_validation_pass', [
    'Valid fields' => [
        [
            'name' => 'name',
            'username' => 'username',
            'email' => 'email@mail.com',
            'role_id' => 1,
            'permissions' => [1,2,3]
        ],
    ],
]);

dataset('staff_user_without_permissions', [
    'User Without Permissions' => fn() => User::factory()->create()
]);

/* Basic Tests */

test('index', function () {
    $response = actingAs($this->superAdminUser)->getJson(route('users.index'));

    $response->assertOk()
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
});

test('store', function () {
    $response = actingAs($this->superAdminUser)->postJson(route('users.store'), $this->userPayload);

    $response->assertCreated()
            ->assertJsonStructure([
                'id',
                'name',
                'username',
                'email',
                'status',
                'created_at',
                'updated_at',
                'roles',
                'permissions'
            ]);
    $this->assertDatabaseHas('users', [
        'email' => $this->userPayload['email']
    ]);
});

test('show', function () {
    $response = actingAs($this->superAdminUser)->getJson(route('users.show', $this->superAdminUser->id));

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'username',
                'email',
                'status',
                'created_at',
                'updated_at',
                'roles',
                'permissions'
            ]);
});

test('update', function () {
    $response = actingAs($this->superAdminUser)->putJson(route('users.update', $this->superAdminUser->id), $this->userPayload);

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'username',
                'email',
                'status',
                'created_at',
                'updated_at',
                'roles',
                'permissions'
            ]);
    $this->assertDatabaseHas('users', [
        'email' => $this->userPayload['email']
    ]);
});

test('destroy', function () {
    $user = User::factory()->hasAttached(Role::find(1))->create();

    $response = actingAs($this->superAdminUser)->deleteJson(route('users.destroy', $user->id));

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'username',
                'email',
                'status',
                'created_at',
                'updated_at',
                'roles',
                'permissions'
            ]);
    $this->assertModelMissing($user);
});


/* Validation Tests */

test('store_validation_fail', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->postJson(route('users.store'), $validationPayload);

    $response->assertUnprocessable()
            ->assertJsonValidationErrors(array_keys($validationPayload));
})->with('store_validation_fail');

test('store_validation_pass', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->postJson(route('users.store'), $validationPayload);

    $response->assertCreated()
            ->assertJsonMissingValidationErrors(array_keys($validationPayload));
})->with('store_validation_pass');

test('update_validation_fail', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->putJson(route('users.update', $this->superAdminUser->id), $validationPayload);

    $response->assertUnprocessable()
            ->assertJsonValidationErrors(array_keys($validationPayload));
})->with('update_validation_fail');

test('update_validation_pass', function ($validationPayload) {
    $response = actingAs($this->superAdminUser)->putJson(route('users.update', $this->superAdminUser->id), $validationPayload);

    $response->assertOk()
            ->assertJsonMissingValidationErrors(array_keys($validationPayload));
})->with('update_validation_pass');


/* Permission Tests */

test('cannot_access_index', function ($user) {
    $response = actingAs($user)->getJson(route('users.index'));

    $response->assertForbidden();
})->with('staff_user_without_permissions');

test('cannot_access_store', function ($user) {
    $response = actingAs($user)->postJson(route('users.store'));

    $response->assertForbidden();
})->with('staff_user_without_permissions');

test('cannot_access_show', function ($user) {
    $response = actingAs($user)->getJson(route('users.show', $user->id));

    $response->assertForbidden();
})->with('staff_user_without_permissions');

test('cannot_access_update', function ($user) {
    $response = actingAs($user)->putJson(route('users.update', $user->id));

    $response->assertForbidden();
})->with('staff_user_without_permissions');

test('cannot_access_destroy', function ($user) {
    $response = actingAs($user)->deleteJson(route('users.destroy', $user->id));

    $response->assertForbidden();
})->with('staff_user_without_permissions');
