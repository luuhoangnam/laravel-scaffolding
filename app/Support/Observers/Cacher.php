<?php

namespace App\Support\Observers;

use Illuminate\Cache\TaggableStore;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cacher
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Support\Observers
 *
 */
class Cacher
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
        $this->cache = $cache;
    }

    /**
     * @param $model
     */
    public function saved(Model $model)
    {
        $this->cache->tags($model->getTable())->flush();
    }

}