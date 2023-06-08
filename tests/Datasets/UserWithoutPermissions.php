<?php

use App\Models\User\User;

dataset('user_without_permissions', [
    'User Without Permissions' => fn() => User::factory()->create()
]);

