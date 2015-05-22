<?php


namespace App\Http\View\Composers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\View;


/**
 * Class ContextComposer
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Http\View\Composers
 *
 */
class ContextComposer
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('settings', $this->config['settings']);
    }
}