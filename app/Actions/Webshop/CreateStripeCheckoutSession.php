<?php

namespace App\Actions\Webshop;

use App\Models\Cart;

use Illuminate\Database\Eloquent\Collection;
use function auth;

class CreateStripeCheckoutSession
{
    public function createFromCart(Cart $cart)
    {
       return $cart->user
           ->allowPromotionCodes()
           ->checkout(
            $this->formatCartItems($cart->items),
               [
                   'customer_update' => [
                       'shipping' => 'auto',
                       ],
                   'shipping_address_collection' => [
                       'allowed_countries' => [ 'IE', 'GB'],
                   ],
                   'metadata' => [
                       'user_id' => $cart->user->id,
                       'cart_id' => $cart->id,
                   ],

               ]
       );
    }

    private function formatCartItems(Collection $items) : array
    {
        return $items->loadMissing('product', 'variant')->map(fn($item) => [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $item->product->name,
                    'description' => "Size: {$item->variant->size} - Color: {$item->variant->color}",
                    'metadata' => [
                        'product_id' => $item->product->id,
                        'product_variant_id' => $item->variant->id,
                    ]
                ],
                'unit_amount' => $item->product->price->getAmount(),
            ],
            'quantity' => $item->quantity,
        ])->toArray();
    }
}
