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
use App\Http\Controllers\BuyController;
use App\Http\Controllers\PaperController;
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
    $lands = Land::where('type', 'Commercial')->get();
    return view('pages.land.commercial')->with('lands', $lands);
});

Route::get('/farmland', function () {
    $lands = Land::where('type', 'Farmland')->get();
    return view('pages.land.farmland')->with('lands', $lands);
});
Route::get('/industrial', function () {
    $lands = Land::where('type', 'Industrial')->get();
    return view('pages.land.industrial')->with('lands', $lands);
});
Route::get('/residential', function () {
    $lands = Land::where('type', 'Residential')->get();
    return view('pages.land.residential')->with('lands', $lands);
});
Route::get('/investments', function () {
    return view('pages.home-01');
});

// single land
Route::get('/single-land-properties', function() {
    return view('pages.land.single-land-properties');
});


Route::get('/single-property-1/{$id}', function ($id) {
    $properties = Property::all();
    $property = Property::find($id);
    return view('pages.single-properties-for-sale.single-property-1')->with([
        'property' => $property,
        'properties' => $properties
    ]);
});

// for rent
Route::get('/all-properties-for-rent', function () {
    $properties = Property::where('category_id', 1)->get();
    return view('pages.all-properties-for-rent')->with('properties', $properties);
});

Route::get('/apartments-for-rent', function () {
    $properties = Property::where('category_id', 1)->where('type_id', 2)->get();
    return view('pages.for-rent.apartments-for-rent')->with('properties', $properties);
});

Route::get('/houses-for-rent', function () {
    $properties = Property::where('category_id', 1)->where('type_id', 1)->get();
    return view('pages.for-rent.houses-for-rent')->with('properties', $properties);
});

Route::get('/offices-for-rent', function () {
    $properties = Property::where('category_id', 1)->where('type_id', 3)->get();
    return view('pages.for-rent.offices-for-rent')->with('properties', $properties);
});

Route::get('/rented-properties', function () {
    return view('pages.for-rent.rented-properties');
});
// end for rent

// for sale
Route::get('/all-properties-for-sale', function () {
    $properties = Property::where('category_id', 2)->get();
    return view('pages.all-properties-for-sale')->with('properties', $properties);
});

Route::get('/apartment-for-sale', function () {
    $properties = Property::where('category_id', 2)->where('type_id', 2)->get();
    return view('pages.for-sale.apartment-for-sale')->with('properties', $properties);
});

Route::get('/houses-for-sale', function () {
    $properties = Property::where('category_id', 2)->where('type_id', 1)->get();
    return view('pages.for-sale.houses-for-sale')->with('properties', $properties);
});

Route::get('/offices-for-sale', function () {
    $properties = Property::where('category_id', 2)->where('type_id', 3)->get();
    return view('pages.for-sale.offices-for-sale')->with('properties', $properties);
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
    Route::resource('buys', BuyController::class);
    Route::resource('options', OptionController::class);
});

Route::resource('pages', PageController::class);
Route::resource('papers', PaperController::class);
