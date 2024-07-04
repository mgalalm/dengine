<?php

namespace App\Actions\Webshop;

use App\Models\Cart;

class MigrateSessionCart
{
    public function migrate(Cart $sessionCart, Cart $userCart): void
    {
        // Migrate the session cart to the authenticated user's cart
        // log the session cart items
        $sessionCart->items->each(fn ($item) => (new AddProductVariantToCart())->add(
            variantId: $item->product_variant_id,
            quantity: $item->quantity,
            cart: $userCart
        ));

        // Delete the session cart
        $sessionCart->items()->delete();
        $sessionCart->delete();
    }
}
