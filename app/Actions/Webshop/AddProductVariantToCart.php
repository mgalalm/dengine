<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;
use function auth;

class AddProductVariantToCart
{
    public function add(int $variantId, $quantity = 1, $cart = null): void {
        // check if the user is logged in
        // we use the seesion_id to store the cart for guest users
        ($cart ?: CartFactory::make())->items()->firstOrCreate([ 'product_variant_id' => $variantId], [
            'product_variant_id' => $variantId,
            'quantity' => 0,
        ])->increment('quantity', $quantity);

    }


}
