<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\FeedContoller;

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


Route::get('lang/{lang}', function($lang){
	
	app()->setLocale($lang);
	session()->put('locale', $lang);
	// app()->getLocale($lang);
	return redirect()->route('dashboard');
})->name('lang');

Route::get('', [DashboardController::class, 'index'])
	->name('dashboard');

Route::get('/terms', function () {
	return view('terms');
});

//ideas route
Route::group(['prefix' => '/ideas', 'as' => 'ideas.'], function () {
	Route::post('/', [IdeaController::class, 'store'])
		->name('store');
	Route::get('/{idea}', [IdeaController::class, 'show'])
		->name('show');

	Route::group(['middleware' => ['auth']], function () {
		Route::get('/{idea}/edit', [IdeaController::class, 'edit'])
			->name('edit');
		Route::put('/{idea}', [IdeaController::class, 'update'])
			->name('update');
		Route::delete('/{idea}', [IdeaController::class, 'destroy'])
			->name('destroy');
		Route::post('/{idea}/comments', [CommentController::class, 'store'])
			->name('comments.store');
	});
});
Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)->only('edit', 'update')
		->middleware('auth');

Route::get('/profile', [UserController::class, 'profile'])
	->middleware('auth')->name('profile');

Route::post('/users/{user}/follow', [FollowerController::class, 'follow'])
			->middleware('auth')->name('users.follow');

Route::post('/user/{user}/follow', [FollowerController::class, 'unfollow'])
			->middleware('auth')->name('users.unfollow');

Route::post('/ideas/{idea}/like', [IdeaLikeController::class, 'like'])
			->middleware('auth')->name('ideas.like');

Route::post('/ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])
			->middleware('auth')->name('ideas.unlike');

Route::get('/feed', FeedContoller::class)
			->name('feed')->middleware('auth');
	
Route::get('/admin', [AdminDashboardController::class, 'index'])
			->name('admin.dashboard')->middleware(['auth', 'can:admin']);