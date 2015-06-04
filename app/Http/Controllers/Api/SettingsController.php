<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Setting;
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
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $keys = $request->get('keys', []);

        $builder = Setting::lastest();

        if ($keys) {
            $builder->whereIn('key', $keys);
        }

        $results = $builder->get('key', 'value');

        return [
            'params' => $results->lists('value', 'key')
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            Setting::where('key', '=', $key)->update(['value' => $value]);
        }

        return ['success' => true];
    }

}
