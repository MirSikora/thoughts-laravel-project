<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\ThoughtLikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [DashboardController::class, 'index'] )->name('dashboard');

Route::resource('thoughts', ThoughtController::class)->except(['index','create','show'])->middleware('auth');

Route::resource('thoughts', ThoughtController::class)->only(['show']);

Route::resource('thoughts.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show','edit','update'])->middleware('auth');

Route::get('profile',[UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('users/{user}/follow', [FollowerController::class,'follow'])->name('users.follow')->middleware('auth');
Route::post('users/{user}/unfollow', [FollowerController::class,'unfollow'])->name('users.unfollow')->middleware('auth');

Route::post('thoughts/{thought}/like', [ThoughtLikeController::class,'like'])->name('thoughts.like')->middleware('auth');
Route::post('thoughts/{thought}/unlike', [ThoughtLikeController::class,'unlike'])->name('thoughts.unlike')->middleware('auth');

Route::get('/feed', FeedController::class)->name('feed')->middleware('auth');

Route::get('/terms', function(){
    return view('terms');
})->name('terms');

Route::middleware(['auth','can:admin'])->prefix('/admin')->as('admin.')->group(function(){

    Route::get('/', [AdminDashboardController::class, 'index'] )->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'] )->name('users');

});

