<?php


use App\Livewire\Cart;
use App\Livewire\MyOrders;
use App\Livewire\Product;
use App\Livewire\StoreFront;
use App\Livewire\CheckoutStatus;
use App\Livewire\ViewOrder;
use Illuminate\Support\Facades\Route;


Route::get('/', StoreFront::class)->name('home');
//Route to the product details page
Route::get('/product/{product}', Product::class)->name('product');
Route::get('/cart', Cart::class)->name('cart');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/checkout-status', CheckoutStatus::class)->name('checkout-status');
    Route::get('/order/{orderId}', ViewOrder::class)->name('view-order');
    Route::get('/my-orders', MyOrders::class)->name('my-orders');
});
// add checkout route
//Route::get('/checkout', function () {
//    return view('checkout');
//})->name('checkout');

// add view order route


Route::get('preview', function () {
    $order = App\Models\Order::find(1);
    return new App\Mail\OrderConfirmation($order);
});
//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});
