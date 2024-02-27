<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Http\Request;

class ThoughtLikeController extends Controller
{
    public function like(Thought $thought){
        $liker = auth()->user();

        if($liker instanceof User){
            $liker->likes()->attach($thought);
        }

        return redirect()->route('dashboard')->with('success','Liked successfully!');
    }

    public function unlike(Thought $thought){

        $liker = auth()->user();

        if($liker instanceof User){
            $liker->likes()->detach($thought);
        }

        return redirect()->route('dashboard')->with('success','UnLiked successfully!');
    }
}
