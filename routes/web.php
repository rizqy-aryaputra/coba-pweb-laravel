<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreferenceController;

Route::get(
    '/reset-visit',
    [ProductController::class, 'resetVisit']
)->name('reset.visit');

Route::get('/', function () {

    if(auth()->check()){
        return redirect('/dashboard');
    }

    return redirect('/login');

});

Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware(['auth', 'verified'])
->name('dashboard');


Route::view('/preferensi', 'preferences');

Route::post(
    '/save-preferences',
    [PreferenceController::class, 'save']
);

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/search-products', [ProductController::class, 'search'])
    ->name('products.search');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'cekadmin'])->group(function () {

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

});


/*
|--------------------------------------------------------------------------
| SHOW PRODUCT
|--------------------------------------------------------------------------
| TARUH PALING BAWAH
|--------------------------------------------------------------------------
*/

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';