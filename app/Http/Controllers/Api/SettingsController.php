<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Setting;
use Illuminate\Cache\TaggableStore;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class SettingsController
 * @package App\Http\Controllers\Api
 */
class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $settings = Setting::all('id', 'key', 'value');

        return $settings;
    }

    /**
     * Display the specified resource.
     *
     * @param string $key
     *
     * @return Response
     *
     */
    public function show($key)
    {
        return Setting::findByKey($key, ['key', 'value']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request                  $request
     * @param Repository|TaggableStore $cache
     *
     * @return Response
     */
    public function update(Request $request, Repository $cache)
    {
        $settings = $request->get('settings', []);

        array_map(function ($setting) {
            Setting::where('key', '=', $setting['key'])->update(['value' => $setting['value']]);
        }, $settings);

        $cache->tags('settings')->flush();

        return ['success' => true];
    }

}
