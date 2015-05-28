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
        $faker = Faker\Factory::create();

        $admin = User::create([
            'slug'     => 'luuhoangnam',
            'name'     => 'Luu Hoang Nam',
            'email'    => 'hoangnam0705@icloud.com',
            'password' => bcrypt('secret'),
            'avatar'   => 'https://vi.gravatar.com/userimage/60910448/7433a8711552f3f956b7815fe81b3fdd.jpg?size=200',
            'role_id'  => 1
        ]);

        foreach (range(1, 100) as $index) {
            $user       = new User;
            $user->name = $faker->name;

            $suffix = '';
            do {
                $slug   = str_slug($user->name) . $suffix;
                $suffix = mt_rand(0, 9);
            } while (User::findBySlug($slug));

            $user->slug       = $slug;
            $user->email      = $faker->email;
            $user->password   = bcrypt('secret');
            $user->avatar     = $faker->imageUrl;
            $user->bio        = $faker->sentence;
            $user->searchable = true;
            $user->role_id    = 3;

            $user->save();
        }
    }
}
