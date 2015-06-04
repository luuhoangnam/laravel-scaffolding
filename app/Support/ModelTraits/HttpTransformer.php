<?php

namespace App\Support\ModelTraits;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * Trait HttpTransformer
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package App\Support\ModelTraits
 *
 */
trait HttpTransformer
{

    /**
     * @param Builder $query
     * @param Request $request
     *
     * @return mixed
     */
    public function scopeApply($query, Request $request)
    {
        // Ascending Order
        if (($asc = $request->get('asc')))
            $query->orderBy($asc);

        // Descending Order
        if (($desc = $request->get('desc')))
            $query->orderBy($desc, 'desc');

        // Filter
        if (($filter = $request->get('filter'))) {
            $segments = explode(':', $filter);
            $query->where($segments[0], 'like', "%{$segments[1]}%");
        }

        // With Relations
//        if (($relations = $request->get('with'))) {
//            $relations = explode(',', $relations);
//
//            $query->with($relations);
//        }

        // Limit
        $this->setPerPage($request->get('limit', $this->getPerPage()));

        return $query;
    }
}
