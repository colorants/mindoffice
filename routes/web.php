<?php

use App\Http\Controllers\AdressController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoCategoryController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/search', [AdressController::class, 'search'])->name('adresses.search');


// User Profile Routes
Route::get('/users', [UserController::class, 'display_all'])->name('users.display_all'); // Display all users
Route::get('/profile', [UserController::class, 'index'])->name('users.index'); // Define the route for user profiles
Route::put('/profile/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
Route::post('/users/{user}/remove-admin', [UserController::class, 'removeAdmin'])->name('users.remove-admin');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete User



// Adress Routes
Route::get('/adresses', [AdressController::class, 'index'])->name('adresses.index');
Route::get('/adresses/create', [AdressController::class, 'create'])->name('adresses.create'); // Create Adress Form
Route::post('/adresses', [AdressController::class, 'store'])->name('adresses.store'); // Store New Adress
Route::get('/adresses/{adress}', [AdressController::class, 'show'])->name('adresses.show'); // View Single Adress
Route::get('/adresses/{adress}/edit', [AdressController::class, 'edit'])->name('adresses.edit'); // Edit Adress Form
Route::put('/adresses/{adress}', [AdressController::class, 'update'])->name('adresses.update'); // Update Adress
Route::delete('/adresses/{adress}', [AdressController::class, 'destroy'])->name('adresses.destroy'); // Delete Adress

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create'); // Create company Form
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store'); // Store New company
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show'); // View Single company
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit'); // Edit company Form
Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update'); // Update company
Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy'); // Delete company


Route::get('form', [CountryController::class, 'index']);


// Authentication Routes
Auth::routes();

// Resource Routes
Route::resource('categories', VideoCategoryController::class);
Route::resource('adresses', AdressController::class);
