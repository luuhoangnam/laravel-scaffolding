<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\JsonResponse;

/**
 * Class SlugsController
 * @package App\Http\Controllers\Api
 */
class SlugsController extends Controller
{

    /**
     * Create a unique slug for the given type and its name
     *
     * @param string $type
     * @param string $name
     *
     * @return JsonResponse
     */
    public function generate($type, $name)
    {
        if ( ! in_array($type, ['post', 'user', 'tag']))
            abort(404);

        $modelClass = "\\App\\" . studly_case($type);

        $suffix = '';
        $slug   = str_slug($name);

        do {
            $slug .= ($suffix ? '' : '-') . $suffix;

            $suffix = mt_rand(0, 9);
        } while (forward_static_call([$modelClass, 'findBySlug'], $slug, ['id']));

        return json(['slug' => $slug]);
    }

}
