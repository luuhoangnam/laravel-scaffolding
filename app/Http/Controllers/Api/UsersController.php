<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class UsersController
 * @package App\Http\Controllers\Api
 */
class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fields = $request->has('fields') ? explode(',', $request->get('fields')) : [];
        $users  = User::apply($request)->get();

        $res = new Collection;
        foreach ($users as $user) {
            $res[] = $user->toApi($fields);
        }

        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     *
     */
    public function show($id)
    {
        if(($user = User::find($id)))
            abort(404);

        return $user->toApi();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     *
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only('slug', 'name', 'email'));

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return Response
     *
     */
    public function destroy(User $user)
    {
        return json(['success' => $user->delete()]);
    }

}
