<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

if ( ! function_exists('json')) {
    /**
     * Respond json response
     *
     * @param array|mixed $data
     * @param int         $status
     * @param array       $headers
     * @param int         $options
     *
     * @return JsonResponse
     */
    function json($data = null, $status = 200, $headers = [], $options = 0)
    {
        return new JsonResponse($data, $status, $headers, $options);
    }
}

if ( ! function_exists('setting')) {
    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    function setting($key, $default = null)
    {
        return app('config')['settings'][$key] ?: $default;
    }
}

if ( ! function_exists('enabled')) {
    /**
     * @param string $key
     *
     * @return bool
     */
    function enabled($key)
    {
        return boolval(setting($key)) === true;
    }
}

if ( ! function_exists('disabled')) {
    /**
     * @param string $key
     *
     * @return bool
     */
    function disabled($key)
    {
        return boolval(setting($key)) === false;
    }
}

if ( ! function_exists('parsedown')) {
    /**
     * @param string $markdown
     *
     * @return string
     */
    function parsedown($markdown)
    {
        $parser = new Parsedown;

        return $parser->text($markdown);
    }
}

if ( ! function_exists('viewext')) {
    /**
     * @param string|array $view
     * @param array        $data
     * @param array        $mergeData
     *
     * @return \Illuminate\View\View
     */
    function viewext($view = null, $data = [], $mergeData = [])
    {
        $parts = $view;

        if (is_string($view))
            $parts = [$view];

        do {
            $view = join('-', $parts);

            array_pop($parts);
        } while ( ! view()->exists($view) && count($parts));

        return view($view, $data, $mergeData);
    }
}





