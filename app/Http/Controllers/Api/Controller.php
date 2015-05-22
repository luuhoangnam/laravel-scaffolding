<?php

namespace App\Http\Controllers\Api;

use Illuminate\Contracts\Auth\Guard;
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
     * @var Guard
     */
    private $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->middleware('restricted');
        $this->auth = $auth;
    }
}
