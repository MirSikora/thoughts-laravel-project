<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $user = auth()->user();

        if($user instanceof User){
            $followingIDs = $user->followings()->pluck('user_id');
            $thoughts = Thought::whereIn('user_id',$followingIDs)->latest();
        }

        if(request()->has('search')){
            $thoughts = $thoughts->search(request('search',''));
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(2),
            'title' => 'Feed'
        ]);
    }
}
