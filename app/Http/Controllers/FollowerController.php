<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user){

        $follower = auth()->user();
        if($follower instanceof User){
            $follower->followings()->attach($user);
        }

        return redirect()->route('users.show',$user->id)->with('success','Followed successfully!');
    }

    public function unfollow(User $user){

        $follower = auth()->user();

        if($follower instanceof User){
            $follower->followings()->detach($user);
        }

        return redirect()->route('users.show',$user->id)->with('success','Unfollowed successfully!');

    }
}
