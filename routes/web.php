<?php

use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\VideoCategoryController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Routes
Route::get('/', [VideoController::class, 'index'])->name('videos.index');

// User Profile Routes
Route::get('/users', [ProfilePageController::class, 'display_all'])->name('users.display_all'); // Display all users
Route::get('/profile', [ProfilePageController::class, 'indexdi'])->name('users.index'); // Define the route for user profiles
Route::put('/profile/{user}', [ProfilePageController::class, 'update'])->name('users.update');
Route::get('/profile/{user}/edit', [ProfilePageController::class, 'edit'])->name('users.edit');


// Video Routes
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create'); // Create Video Form
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store'); // Store New Video
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show'); // View Single Video
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit'); // Edit Video Form
Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update'); // Update Video
Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy'); // Delete Video
Route::post('/videos/{video}/favorite', [VideoController::class, 'toggleFavorite'])->name('videos.favorite.toggle'); // Toggle Video Favorite Status

// Video Category Routes
Route::get('/categories', [VideoCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [VideoCategoryController::class, 'create'])->name('categories.create'); // Create Category Form
Route::post('/categories', [VideoCategoryController::class, 'store'])->name('categories.store'); // Store New Category
Route::get('/categories/{category}', [VideoCategoryController::class, 'show'])->name('categories.show'); // View Single Category
Route::get('/categories/{category}/edit', [VideoCategoryController::class, 'edit'])->name('categories.edit'); // Edit Category Form
Route::put('/categories/{category}', [VideoCategoryController::class, 'update'])->name('categories.update'); // Update Category
Route::delete('/categories/{category}', [VideoCategoryController::class, 'destroy'])->name('categories.destroy'); // Delete Category

// Authentication Routes
Auth::routes();

// Resource Routes
Route::resource('categories', VideoCategoryController::class);
Route::resource('videos', VideoController::class);
