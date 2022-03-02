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
use App\Http\Controllers\PageController;
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
    $sales = Property::where('category_id', 2)->get()->take(8);
    $rents = Property::where('category_id', 1)->get()->take(8);

    return view('pages.home-01')->with([
        'properties' => $properties,
        'sales' => $sales,
        'rents' => $rents
    ]);
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

// Route::get('/lands-residential', function () {
//     $lands = Land::where('type', 'Residential')->get();
//     return view('pages.home-01')->with('lands', $lands);
// });
// Route::get('/lands-industrial', function () {
//     $lands = Land::where('type', 'Industrial')->get();
//     return view('pages.home-01')->with('lands', $lands);
// });
// Route::get('/lands-commercial', function () {
//     $lands = Land::where('type', 'Commercial')->get();
//     return view('pages.home-01')->with('lands', $lands);
// });
// Route::get('/lands-farmland', function () {
//     $lands = Land::where('type', 'Farmland')->get();
//     return view('pages.home-01')->with('lands', $lands);
// });

// routes for land dropdown items

Route::get('/commercial', function () {
    return view('pages.land.commercial');
});

Route::get('/farmland', function () {
    return view('pages.land.farmland');
});
Route::get('/industrial', function () {
    return view('pages.land.industrial');
});
Route::get('/residential', function () {
    return view('pages.land.residential');
});
Route::get('/investments', function () {
    return view('pages.home-01');
});
Route::get('/single-property-1/{$id}', function ($id) {
    $property = Property::find($id);
    return view('pages.single-properties-for-sale.single-property-1')->with([
        'property' => $property
    ]);
});

// for rent
Route::get('/all-properties-for-rent', function () {
    return view('pages.all-properties-for-rent');
});

Route::get('/apartments-for-rent', function () {
    return view('pages.for-rent.apartments-for-rent');
});

Route::get('/houses-for-rent', function () {
    return view('pages.for-rent.houses-for-rent');
});

Route::get('/offices-for-rent', function () {
    return view('pages.for-rent.offices-for-rent');
});

Route::get('/rented-properties', function () {
    return view('pages.for-rent.rented-properties');
});
// end for rent

// for sale
Route::get('/all-properties-for-sale', function () {
    return view('pages.all-properties-for-sale');
});

Route::get('/apartment-for-sale', function () {
    return view('pages.for-sale.apartment-for-sale');
});

Route::get('/houses-for-sale', function () {
    return view('pages.for-sale.houses-for-sale');
});

Route::get('/offices-for-sale', function () {
    return view('pages.for-sale.offices-for-sale');
});

Route::get('/sold-properties', function () {
    return view('pages.for-sale.sold-properties');
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

Route::resource('pages', PageController::class);