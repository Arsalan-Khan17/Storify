<?php

use App\Http\Controllers\StoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){

    // Route::get('/stories',[StoriesController::class,'index'])->name('stories.index');
    // Route::get('/stories/{story}',[StoriesController::class,'show'])->name('stories.show');
    Route::resource('/stories',StoriesController::class);
});


Route::get('/' , [DashboardController::class,'index'])->name('dashboard.index');
Route::get('/story/{activeStory}' , [DashboardController::class,'show'])->name('dashboard.show');