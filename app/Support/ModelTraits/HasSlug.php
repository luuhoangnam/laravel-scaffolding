<?php

namespace App\Support\ModelTraits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasSlug
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Support\ModelTraits
 *
 */
trait HasSlug
{
    public function getRouteKey()
    {
        return $this->slug;
    }

    /**
     * @param Builder $query
     * @param string  $slug
     *
     * @return mixed
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', '=', $slug);
    }

    /**
     * @param string $slug
     * @param array  $columns
     *
     * @return Model|null
     */
    public static function findBySlug($slug, $columns = ['*'])
    {
        return static::slug($slug)->first($columns);
    }
}
