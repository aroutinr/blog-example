<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_count = User::all()->count();
        $users = User::paginate(15);

        return view('admin.users.index', compact('users_count', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        return back()->with('status', 'User ' . $user->name . ' Created.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return back()->with('status', 'User ' . $user->name . ' Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id === 1) 
        {
            return back()->with('status', 'You cannot delete this user (' . $user->name . ') as it is the default user.');
        }
        if ($user == auth()->user()) 
        {
            return back()->with('status', 'You cant remove yourself.');
        }

        $user->delete();

        return back()->with('status', 'User ' . $user->name . ' Deleted.');
    }
}
