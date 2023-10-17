<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\VideoCategoryController;
use App\Http\Controllers\VideoController;
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


Route::get('/', [VideoController::class, 'index']);
Route::get('/users', [ProfilePageController::class, 'index'])->name('users.index');
Route::get('/home', [VideoController::class, 'index']);
Route::put('/users/{user}', [ProfilePageController::class, 'update'])->name('users.update');

// Example route for viewing a video
Route::post('/videos/{video}/favorite', [VideoController::class,'toggleFavorite'])->name('videos.favorite.toggle');

Route::get('/videos/{video}', 'VideoController@show')->middleware('video.access');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::get('/categories', [VideoCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [VideoCategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/{category}', [VideoCategoryController::class, 'show'])->name('categories.show');
Route::put('/categories/{category}', [VideoCategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{category}/edit', [VideoCategoryController::class, 'edit'])->name('categories.edit');

Auth::routes();

Route::resource('categories', VideoCategoryController::class);
Route::resource('videos', VideoController::class);

