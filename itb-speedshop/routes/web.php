<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::all(); // Ambil semua barang

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

    // Cart & Checkout Support - Customer Only
    Route::middleware(['customer'])->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success/{order}', [CartController::class, 'success'])->name('checkout.success');
        
        // Order details route for customers
        Route::get('/order/{order}', function (\App\Models\Order $order) {
            // Verify ownership
            if ($order->user_id !== auth()->id()) {
                abort(403);
            }
            $order->load('items');
            return view('dashboard.order-detail', compact('order'));
        })->name('order.show');
    });
    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

        // Order Management Routes
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    });
});

// Public catalog routes - accessible by guests and logged-in users
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/categories', [ProductController::class, 'categories'])->name('categories');

Route::get('/workshop', function () {
    return view('workshop');
})->name('workshop');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/payments/midtrans-notification', [PaymentCallbackController::class, 'handle']);
require __DIR__.'/auth.php';
