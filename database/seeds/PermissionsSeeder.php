<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

/**
 * Class PermissionsSeeder
 */
class PermissionsSeeder extends Seeder
{
    protected $roles = [
        [
            'name'        => 'Administrator',
            'description' => 'Administrators',
        ],
        [
            'name'        => 'Editor',
            'description' => 'Editors',
        ],
        [
            'name'        => 'Author',
            'description' => 'Authors',
        ],
        [
            'name'        => 'Registered User',
            'description' => 'Registered Users',
        ],
    ];

    protected $permissions = [
        // ## Settings
        [
            'name'     => 'Browse settings',
            'resource' => 'setting',
            'action'   => 'browse',
        ],
        [
            'name'     => 'Read settings',
            'resource' => 'setting',
            'action'   => 'read',
        ],
        [
            'name'     => 'Edit settings',
            'resource' => 'setting',
            'action'   => 'browse',
        ],
        // ## Slugs
        [
            'name'     => 'Generate slugs',
            'resource' => 'slug',
            'action'   => 'generate',
        ],
        // ## Users
        [
            'name'     => 'Browse users',
            'resource' => 'user',
            'action'   => 'browse',
        ],
        [
            'name'     => 'Read users',
            'resource' => 'user',
            'action'   => 'read',
        ],
        [
            'name'     => 'Edit users',
            'resource' => 'user',
            'action'   => 'edit',
        ],
        [
            'name'     => 'Delete users',
            'resource' => 'user',
            'action'   => 'destroy',
        ],
        // ## Roles
        [
            'name'     => 'Browse roles',
            'resource' => 'role',
            'action'   => 'browse',
        ],
        [
            'name'     => 'Assign a role',
            'resource' => 'role',
            'action'   => 'assign',
        ],
    ];

    public function run()
    {
        $this->createRoles();
        $this->createPermissions();
    }

    protected function createRoles()
    {
        array_map(function ($role) {
            Role::create($role);
        }, $this->roles);
    }

    protected function createPermissions()
    {
        array_map(function ($permission) {
            Permission::create($permission);
        }, $this->permissions);
    }
}
