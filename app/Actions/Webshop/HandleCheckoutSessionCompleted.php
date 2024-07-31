<?php

namespace App\Actions\Webshop;

use App\Mail\OrderConfirmation;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Cashier;
use Stripe\LineItem;
use function collect;

class HandleCheckoutSessionCompleted
{
    public function handle($sessionId)  {
        // get the cart from the session

        DB::transaction(function () use ($sessionId) {
            // Get the session
            \Log::info('# Beginning of the transaction');
            $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

            // Get the user and cart from the session metadata
            $user = User::find($session->metadata->user_id);
            $cart = Cart::find($session->metadata->cart_id);

            \Log::info('# After  Retrieve the session ');
            // Create the order
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

            \Log::info('# After  Order create ');

            // Get the line items from the session
            $lineItems = Cashier::stripe()->checkout->sessions->allLineItems($sessionId);

            \Log::info('# After  Get the line items from the session');

            // Create the order items
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

            \Log::info('# After  Create the order items ');

            // Empty the cart
            $cart->items()->delete();
            $cart->delete();

            \Log::info('# After  Empty the cart ');

            // Send the order confirmation email
            Mail::to($user)->send(new OrderConfirmation($order));
            \Log::info('# After  Empty the cart ');

            \Log::info('# End of the transaction');
        });

    }
}
