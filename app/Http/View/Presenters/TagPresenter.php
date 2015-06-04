<?php

namespace App\Http\View\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Class TagPresenter
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Presenters
 *
 */
class TagPresenter extends Presenter
{
    /**
     * @return string
     */
    public function url()
    {
        return route('frontend.tag', [$this->entity]);
    }
}
