<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Class UserPresenter
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Presenters
 *
 */
class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function url()
    {
        return route('frontend.author', [$this->entity]);
    }
}
