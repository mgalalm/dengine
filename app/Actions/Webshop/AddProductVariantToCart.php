<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;
use function auth;

class AddProductVariantToCart
{
    public function add(int $variantId): void {
        // check if the user is logged in
        // we use the seesion_id to store the cart for guest users
        CartFactory::make()->items()->create([
            'product_variant_id' => $variantId,
            'quantity' => 1,
        ]);

    }


}
