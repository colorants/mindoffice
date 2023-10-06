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
Route::get('/profile', [ProfilePageController::class, 'index']);
Route::get('/home', [VideoController::class, 'index']);
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::get('/videos/category/{categoryId}', [VideoCategoryController::class, 'byCategory']);
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');

Auth::routes();

Route::resource('videos', VideoController::class);

