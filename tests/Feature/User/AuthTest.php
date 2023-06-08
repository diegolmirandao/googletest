<?php

use App\Models\User\User;
use App\Models\User\Role;

beforeEach(function () {
    $this->user = User::factory(['password' => 'password'])->hasAttached(Role::find(1))->create();
    $this->userPayload = [
        'email' => $this->user->email,
        'password' => 'password',
    ];
});

test('successful login', function () {
    $response = $this->postJson('/api/login', $this->userPayload);

    $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'username',
                'email',
                'email_verified_at',
                'status',
                'created_at',
                'updated_at',
                'role_id',
                'roles',
                'permissions',
            ]);
});

test('successful logout', function () {
    $this->postJson('/api/login', $this->userPayload);

    $responseLogout = $this->get('/api/logout');

    $responseLogout->assertOk();
});

test('login required fields', function () {
    $response = $this->postJson('/api/login');

    $response->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors',
            ]);
});


