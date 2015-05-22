<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class UploadController
 * @package App\Http\Controllers\Api
 */
class UploadController extends Controller
{
    protected $uploadRoot = 'uploads';

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function store(Request $request)
    {
        // Save
        $fileUpload = $request->file('uploadimage');

        // Build
        // i.e: /uploads/2015/05/abc.jpg

        $name = $fileUpload->getClientOriginalName();
        $path = $this->uploadRoot . '/' . date('Y') . '/' . date('m') . '/';

        $fileUpload->move($path, $name);

        return json(['path' => $path . $name], 201);
    }
}
