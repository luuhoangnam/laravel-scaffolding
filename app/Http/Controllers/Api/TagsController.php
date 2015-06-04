<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Tag;
use Illuminate\Cache\TaggableStore;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TagsController
 * @package App\Http\Controllers\Api
 */
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Repository|TaggableStore $cache
     *
     * @return Response
     */
    public function index(Repository $cache)
    {
        $tags = $cache->tags('tags')->remember(md5('all'), setting('cache.ttl'), function () {
            return Tag::lists('name', 'id');
        });

        return json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $tag = Tag::create($request->only('slug', 'name', 'cover', 'story'));

        return json($tag, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag     $tag
     *
     * @return Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->only('slug', 'name', 'cover', 'story'));

        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     *
     * @return Response
     *
     */
    public function destroy(Tag $tag)
    {
        return json(['success' => $tag->delete()]);
    }

}
