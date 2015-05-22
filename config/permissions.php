<?php

return [
    'routes' => [
        // Admin
//        [
//            'method' => 'GET|HEAD',
//            'uri'    => 'admin',
//            'role'   => 'Administrator',
//        ],
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
        // ## Slugs
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/slugs/{type}/{name}',
            'permissions' => ['slug' => 'generate'],
        ],
        // ## Settings
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/settings',
            'permissions' => ['setting' => 'browse'],
        ],
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/settings/{key}',
            'permissions' => ['setting' => 'read'],
        ],
        [
            'method'      => 'PUT',
            'uri'         => 'api/settings',
            'permissions' => ['setting' => 'edit'],
        ],
        // ## Roles
        [
            'method'      => 'GET|HEAD',
            'uri'         => 'api/roles',
            'permissions' => ['role' => 'browse'],
        ],
        // ## Uploads
        [
            'method'      => 'POST',
            'uri'         => 'api/uploads',
            'permissions' => ['upload' => 'store'],
        ],
        // Frontend (not restricted)
//        [
//            'method'      => 'GET',
//            'uri'         => 'author/{slug}',
//            'permissions' => ['user' => 'read'],
//        ],
//        [
//            'method'      => 'GET',
//            'uri'         => 'tag/{slug}',
//            'permissions' => ['tag' => 'read'],
//        ],
//        [
//            'method'      => 'GET',
//            'uri'         => '{slug}',
//            'permissions' => ['post' => 'read'],
//        ],
    ]
];

