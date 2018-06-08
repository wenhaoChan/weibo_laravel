<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        // 如果是自己 则重定向到首页
        if(Auth::user()->id === $user->id) {
            return redirect('/');
        }

        // 没有关注的情况下
        if(!Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        if(Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if(Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }
}
