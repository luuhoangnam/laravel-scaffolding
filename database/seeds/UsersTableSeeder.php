<?php

use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'slug'     => 'luuhoangnam',
            'name'     => 'Luu Hoang Nam',
            'email'    => 'hoangnam0705@icloud.com',
            'password' => bcrypt('secret'),
            'role_id'  => 1
        ]);
    }
}
