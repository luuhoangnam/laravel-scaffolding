<?php

namespace App\Http\View\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Class UserPresenter
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Http\View\Presenters
 *
 */
class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function url()
    {
        return route('frontend.user', [$this->entity]);
    }
}
