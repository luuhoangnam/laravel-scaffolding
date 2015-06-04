<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tag;
use App\User;
use Illuminate\Cache\TaggableStore;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\View\View;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @var Repository|TaggableStore
     */
    private $cache;

    /**
     * @param Repository $cache
     */
    public function __construct(Repository $cache)
    {
        parent::__construct();

        $this->cache = $cache;
    }

    /**
     * @return View
     */
    public function home()
    {
        return viewext('home');
    }

}
