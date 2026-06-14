<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;


Route::get(
    '/reset-visit',
    [ProductController::class, 'resetVisit']
)->name('reset.visit');

Route::view('/', 'welcome')->name('home');

Route::view(
    '/about',
    'about'
)->name('about');

Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware(['auth', 'verified'])
->name('dashboard');


Route::middleware(['auth', 'cekadmin'])->group(function () {

    Route::get('/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');

});

Route::view('/preferensi', 'preferences');

Route::post(
    '/save-preferences',
    [PreferenceController::class, 'save']
);

Route::middleware('auth')->group(function () {

    Route::post(
        '/wishlist/{product}',
        [WishlistController::class, 'toggle']
    )->name('wishlist.toggle');

    Route::get(
        '/wishlist',
        [WishlistController::class, 'index']
    )->name('wishlist.index');

    Route::get(
        '/checkout/{product}',
        [OrderController::class, 'checkout']
    )->name('checkout');

    Route::post(
        '/orders',
        [OrderController::class, 'store']
    )->name('orders.store');

    Route::get(
        '/my-orders',
        [OrderController::class, 'index']
    )->name('orders.index');

    Route::get(
        '/admin/orders',
        [OrderController::class, 'adminIndex']
    )->name('admin.orders');

    Route::post(
        '/admin/orders/{order}/confirm',
        [OrderController::class, 'confirm']
    )->name('admin.orders.confirm');

});

Route::delete(
    '/wishlist/{wishlist}',
    [WishlistController::class, 'destroy']
)->name('wishlist.destroy');


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

Route::patch(
    '/admin/orders/{order}/cancel',
    [OrderController::class, 'cancel']
)->name('orders.cancel');

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