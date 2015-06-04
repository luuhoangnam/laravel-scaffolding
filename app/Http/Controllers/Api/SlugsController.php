<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Services\SlugGenerator;
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
     * @param SlugGenerator $slugs
     * @param string        $type
     * @param string        $name
     *
     * @return JsonResponse
     */
    public function generate(SlugGenerator $slugs, $type, $name)
    {
        $validTypes = ['post', 'user', 'tag'];

        if ( ! in_array($type, $validTypes))
            abort(404);

        $slug = $slugs->generate(str_plural($type), $name);

        return json(['slug' => $slug]);
    }

}
