<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{

    use DispatchesCommands, ValidatesRequests;

    /**
     * Global constructor for all controllers
     */
    public function __construct()
    {
        $this->middleware('restricted');
    }
}
