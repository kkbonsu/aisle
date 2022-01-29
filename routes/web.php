<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;

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
    return view('pages.home-01');
});


Route::get('/single-property-1', function () {
    return view('pages.single-properties-for-sale.single-property-1');
});

Route::get('/all-properties-for-rent', function () {
    return view('pages.all-properties-for-rent');
});

Route::get('/all-properties-for-sale', function () {
    return view('pages.all-properties-for-sale');
});

Route::middleware(['auth:sanctum', 'auth'])->get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('properties', PropertyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('amenities', AmenityController::class);
    Route::resource('users', UserController::class);
    Route::resource('types', TypeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('options', OptionController::class);
});
