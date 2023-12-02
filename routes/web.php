<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::middleware(['admin'])->group(function () {
    
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    

    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');

    Route::get('admin/products/{slug}', [ProductController::class, 'show'])->name('admin.products.show');

    // Show the form for editing a product
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');

    // Update the specified product in the database
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

    // Remove the specified product from the database
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

    Route::get('admin/attributes/create', [AttributeController::class, 'create'])->name('admin.attributes.create');
    Route::get('admin/attributes', [AttributeController::class, 'index'])->name('attributes.index');
    Route::post('admin/attributes', [AttributeController::class, 'store'])->name('admin.attributes.store');

    Route::get('admin/products/{slug}/variations/create', [ProductVariationController::class, 'create'])->name('admin.variations.create');
    Route::get('admin/products/{slug}/variations', [ProductVariationController::class, 'index'])->name('admin.variations.index');
    Route::post('admin/products/{slug}/variations', [ProductVariationController::class, 'store'])->name('admin.variations.store');

});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/products/{slug}', [HomeController::class, 'show'])->name('home.products.show');

Route::post('/cart/add-to-cart/', [CartController::class, 'addToCart'])->name('cart.addToCart')->middleware('auth');
Route::patch('/cart/update-cart/{cartItemId}', [CartController::class, 'updateCart'])->name('cart.updateCart')->middleware('auth');
Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart')->middleware('auth');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.viewCart')->middleware('auth');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');;
Route::post('/checkout/proccess', [CheckoutController::class, 'checkout'])->name('checkout.proccess')->middleware('auth');;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
