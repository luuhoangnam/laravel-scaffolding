<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class UsersController
 * @package App\Http\Controllers\Api
 */
class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::paginate();

        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return Response
     *
     */
    public function show(User $user)
    {
        return $user;
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
