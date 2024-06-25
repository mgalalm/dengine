<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use function auth;

class AddProductVariantToCart
{
    public function add(int $variantId): void {
        // check if the user is logged in
        // we use the seesion_id to store the cart for guest users
        $cart = match( auth()->guest() ) {
            true => Cart::firstOrCreate([
                'session_id' => session()->getId(),
            ]),
            false => auth()->user()->cart ?: auth()->user()->cart()->create(),
        };

        $cart->items()->create([
            'product_variant_id' => $variantId,
            'quantity' => 1,
        ]);

     dd($cart  );
    }


}
