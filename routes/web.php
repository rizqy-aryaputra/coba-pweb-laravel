<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')
    ->name('home');

Route::view('/about', 'about')
    ->name('about');

Route::view('/preferensi', 'preferences');

Route::post(
    '/save-preferences',
    [PreferenceController::class, 'save']
);

Route::get(
    '/search-products',
    [ProductController::class, 'search']
)->name('products.search');

Route::get(
    '/products',
    [ProductController::class, 'index']
)->name('products.index');

Route::get(
    '/products/{product}',
    [ProductController::class, 'show']
)->name('products.show');


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware([
    'auth',
    'verified'
])->name('dashboard');


/*
|--------------------------------------------------------------------------
| SESSION FEATURE
|--------------------------------------------------------------------------
*/

Route::get(
    '/reset-visit',
    [ProductController::class, 'resetVisit']
)->name('reset.visit');


/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->group(function () {

        // Wishlist

        Route::post(
            '/wishlist/{product}',
            [WishlistController::class, 'toggle']
        )->name('wishlist.toggle');

        Route::get(
            '/wishlist',
            [WishlistController::class, 'index']
        )->name('wishlist.index');

        Route::delete(
            '/wishlist/{wishlist}',
            [WishlistController::class, 'destroy']
        )->name('wishlist.destroy');

        // Orders

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
            [OrderController::class, 'index'
        ])->name('orders.index');

        // Profile

        Route::get(
            '/profile',
            [ProfileController::class, 'edit']
        )->name('profile.edit');

        Route::patch(
            '/profile',
            [ProfileController::class, 'update']
        )->name('profile.update');

        Route::delete(
            '/profile',
            [ProfileController::class, 'destroy']
        )->name('profile.destroy');

    });


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'cekadmin'
])->group(function () {

    // Dashboard

    Route::get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');

    // Orders

    Route::get(
        '/admin/orders',
        [OrderController::class, 'adminIndex']
    )->name('admin.orders');

    Route::post(
        '/admin/orders/{order}/confirm',
        [OrderController::class, 'confirm']
    )->name('admin.orders.confirm');

    Route::patch(
        '/admin/orders/{order}/cancel',
        [OrderController::class, 'cancel']
    )->name('orders.cancel');

    // Products

    Route::get(
        '/products/create',
        [ProductController::class, 'create']
    )->name('products.create');

    Route::post(
        '/products',
        [ProductController::class, 'store']
    )->name('products.store');

    Route::get(
        '/products/{product}/edit',
        [ProductController::class, 'edit']
    )->name('products.edit');

    Route::put(
        '/products/{product}',
        [ProductController::class, 'update']
    )->name('products.update');

    Route::delete(
        '/products/{product}',
        [ProductController::class, 'destroy']
    )->name('products.destroy');

});


require __DIR__.'/auth.php';