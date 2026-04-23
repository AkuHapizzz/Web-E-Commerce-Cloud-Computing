<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    $products = \App\Models\Product::all(); // Ambil semua barang
    return view('welcome', compact('products')); // Kirim ke welcome.blade.php
});

Route::get('/dashboard', function () {
    if (auth()->user()->usertype === 'admin') {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }
    
    // For regular users, load their order history
    $orders = auth()->user()->orders()->latest()->get();
    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart & Checkout Support
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    
    Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [\App\Http\Controllers\CartController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [\App\Http\Controllers\CartController::class, 'success'])->name('checkout.success');

    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    });
    
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/categories', [\App\Http\Controllers\ProductController::class, 'categories'])->name('categories');
});

Route::get('/workshop', function () {
    return view('workshop');
})->name('workshop');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

require __DIR__.'/auth.php';
