<?php

$factory('App\User', [
    'slug'        => 'luuhoangnam',
    'name'        => 'Luu Hoang Nam',
    'email'       => 'hoangnam0705@icloud.com',
    'password'    => bcrypt('secret'),
    'avatar'      => 'https://vi.gravatar.com/userimage/60910448/7433a8711552f3f956b7815fe81b3fdd.jpg?size=200',
    'permissions' => ['owner', 'manage_users', 'manage_tags', 'manage_posts'],
]);


