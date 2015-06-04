<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class UploadController
 * @package App\Http\Controllers
 */
class FilesController extends Controller
{
    protected $uploadRoot = 'uploads';

    /**
     * @param Request $request
     * @param string  $name
     *
     * @return string
     */
    public function store(Request $request, $name = null)
    {
        // Save
        $fileUpload = $request->file('uploadfile');

        // Build
        // i.e: /uploads/2015/05/abc.jpg

        $directory = $this->uploadRoot . '/' . date('Y') . '/' . date('m');
        $name      = $name ?: $fileUpload->getClientOriginalName();

        $prefix = '';
        do {
            $name   = $prefix . str_slug($name);
            $prefix = mt_rand(0, 9);
        } while (file_exists(public_path("{$this->uploadRoot}/{$directory}/{$name}")));

        $fileUpload->move($directory, $name);

        return json([
            'path' => "/{$directory}/{$name}",
            'url'  => url("/{$directory}/{$name}"),
        ], 201);
    }

    public function serve()
    {
        abort(404);
    }
}
