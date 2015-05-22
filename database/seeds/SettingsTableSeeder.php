<?php

use App\Setting;
use Illuminate\Database\Seeder;

/**
 * Class SettingsTableSeeder
 */
class SettingsTableSeeder extends Seeder
{
    protected $settings = [
        'title'       => 'Just another laravel instance',
        'description' => 'Thoughts, stories and ideas.',
        'email'       => 'hoangnam0705@icloud.com',
        'logo'        => null,
        'navigation'  => null,
        'theme'       => ['active' => 'mbear'],
        'cache'       => ['ttl' => 1440]
    ];

    public function run()
    {
        foreach ($this->settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }
    }
}
