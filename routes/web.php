<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandController;
use App\Models\Land;
use App\Models\Property;

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
    $properties = Property::all();
    return view('pages.home-01')->with('properties', $properties);
});

Route::get('/rent-apartments', function () {
    $properties = Property::where('category_id', 2)->get();
    return view('pages.home-01')->with('properties', $properties);
});
Route::get('/rent-houses', function () {
    $properties = Property::where('category_id', 1)->get();
    return view('pages.home-01')->with('properties', $properties);
});
Route::get('/rent-offices', function () {
    $properties = Property::where('category_id', 3)->get();
    return view('pages.home-01')->with('properties', $properties);
});
Route::get('/rented-properties', function () {
    return view('pages.home-01');
});

Route::get('/sale-apartments', function () {
    $properties = Property::where('category_id', 2)->get();
    return view('pages.home-01')->with('properties', $properties);
});
Route::get('/sale-houses', function () {
    $properties = Property::where('category_id', 1)->get();
    return view('pages.home-01')->with('properties', $properties);
});
Route::get('/sale-offices', function () {
    $properties = Property::where('category_id', 3)->get();
    return view('pages.home-01')->with('properties', $properties);
});
Route::get('/sold-properties', function () {
    return view('pages.home-01');
});

Route::get('/lands-residential', function () {
    $lands = Land::where('type', 'Residential')->get();
    return view('pages.home-01')->with('lands', $lands);
});
Route::get('/lands-industrial', function () {
    $lands = Land::where('type', 'Industrial')->get();
    return view('pages.home-01')->with('lands', $lands);
});
Route::get('/lands-commercial', function () {
    $lands = Land::where('type', 'Commercial')->get();
    return view('pages.home-01')->with('lands', $lands);
});
Route::get('/lands-farmland', function () {
    $lands = Land::where('type', 'Farmland')->get();
    return view('pages.home-01')->with('lands', $lands);
});

Route::get('/investments', function () {
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
    Route::resource('lands', LandController::class);
    Route::resource('properties', PropertyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('amenities', AmenityController::class);
    Route::resource('users', UserController::class);
    Route::resource('types', TypeController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('options', OptionController::class);
});
