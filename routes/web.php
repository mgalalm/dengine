<?php


use App\Livewire;
use App\Livewire\Cart;
use App\Livewire\Product;
use App\Livewire\StoreFront;
use App\Livewire\CheckoutStatus;
use Illuminate\Support\Facades\Route;

Route::get('/',
    StoreFront::class
)->name('home');

//Route to the product details page
Route::get('/product/{product}',
    Product::class
)->name('product');

Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout-status', CheckoutStatus::class)->name('checkout-status');

// add checkout route
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});
