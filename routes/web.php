<?php


use App\Livewire;
use App\Livewire\Cart;
use App\Livewire\Product;
use App\Livewire\StoreFront;
use Illuminate\Support\Facades\Route;

Route::get('/',
    StoreFront::class
)->name('home');

//Route to the product details page
Route::get('/product/{product}',
    Product::class
)->name('product');

Route::get('/cart', Cart::class)->name('cart');

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});
