<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class DashboardController extends Controller
{
    public function index()
    {
        $thoughts = Thought::orderBy('created_at','DESC');

        if(request()->has('search')){
            $thoughts = $thoughts->search(request('search',''));
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(2),
            'title' => 'Dashboard',
        ]);
    }
}
