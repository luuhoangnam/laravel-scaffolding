<?php

return [
    'routes' => [
        // API
        // ## Users
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/users',
            'permissions' => ['user' => 'browse'],
        ],
        [
            'method'      => 'POST',
            'uri'         => 'api/users',
            'permissions' => ['user' => 'add'],
        ],
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/users/{users}',
            'permissions' => ['user' => 'read'],
        ],
        [
            'method'      => 'PUT',
            'uri'         => 'api/users/{users}',
            'permissions' => ['user' => 'edit'],
        ],
        [
            'method'      => 'DELETE',
            'uri'         => 'api/users/{users}',
            'permissions' => ['user' => 'destroy'],
        ],
        // ## Settings
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/settings',
            'permissions' => 'manage_users',
        ],
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/settings/{key}',
            'permissions' => 'manage_users',
        ],
        [
            'method'      => 'PUT',
            'uri'         => 'api/settings',
            'permissions' => 'manage_users',
        ],
        // ## Roles
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/roles',
            'permissions' => 'manage_users',
        ],
    ]
];

