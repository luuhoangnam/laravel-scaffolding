<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'failed_jobs',
        'password_resets',
        'permission_role',
        'permissions',
        'roles',
        'settings',
        'users',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::statement('SET foreign_key_checks = 0;');

        foreach ($this->tables as $table) {
            \DB::table($table)->truncate();
        }

        $this->call('SettingsTableSeeder');
        $this->call('PermissionsSeeder');
        $this->call('UsersTableSeeder');

        \DB::statement('SET foreign_key_checks = 1;');
    }

}
