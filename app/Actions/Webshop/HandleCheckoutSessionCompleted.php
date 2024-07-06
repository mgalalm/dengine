<?php

namespace App\Actions\Webshop;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Stripe\LineItem;
use function collect;

class HandleCheckoutSessionCompleted
{
    public function handle($sessionId)  {
        // get the cart from the session

        DB::transaction(function () use ($sessionId) {
            $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);
            \Log::info('Session');
            \Log::info($session);
            $user = User::find($session->metadata->user_id);

            $cart = Cart::find($session->metadata->cart_id);

            $order = $user->orders()->create([
                'stripe_checkout_session_id' => $sessionId,
                'amount_shipping' => $session->total_details->amount_shipping,
                'amount_discount' => $session->total_details->amount_discount,
                'amount_tax' => $session->total_details->amount_tax,
                'amount_subtotal' => $session->amount_subtotal,
                'amount_total' => $session->amount_total,
                'shipping_address' => [
                    'name' => $session->shipping_details->name,
                    'country' => $session->shipping_details->address->country,
                    'city' => $session->shipping_details->address->city,
                    'state' => $session->shipping_details->address->state,
                    'line1' => $session->shipping_details->address->line1,
                    'line2' => $session->shipping_details->address->line2,
                    'postal_code' => $session->shipping_details->address->postal_code,


                ],
                'billing_address' => [
                    'name' => $session->customer_details->name,
                    'country' => $session->customer_details->address->country,
                    'city' => $session->customer_details->address->city,
                    'state' => $session->customer_details->address->state,
                    'line1' => $session->customer_details->address->line1,
                    'line2' => $session->customer_details->address->line2,
                    'postal_code' => $session->customer_details->address->postal_code,

                ],
            ]);

            $lineItems = Cashier::stripe()->checkout->sessions->allLineItems($sessionId);
            $orderItems = collect($lineItems->all())->map(function(LineItem $lineItem) {

                $product = Cashier::stripe()->products->retrieve($lineItem->price->product);

                return [
                    'product_variant_id' => $product->metadata->product_variant_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $lineItem->price->unit_amount,
                    'quantity' => $lineItem->quantity,
                    'amount_discount' => $lineItem->amount_discount,
                    'amount_tax' => $lineItem->amount_tax,
                    'amount_subtotal' => $lineItem->amount_subtotal,
                    'amount_total' => $lineItem->amount_total,
                ];
            });

            $order->items()->createMany($orderItems->toArray());
            $cart->items()->delete();
            $cart->delete();
        });

    }
}
