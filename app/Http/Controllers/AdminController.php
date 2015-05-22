<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * @return View
     */
    public function index()
    {
        return view('admin');
    }

}
