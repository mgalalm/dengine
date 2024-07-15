<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'amount_shipping' => $this->faker->randomFloat(2, 0, 1000),
            'amount_discount' => $this->faker->randomFloat(2, 0, 1000),
            'amount_tax' => $this->faker->randomFloat(2, 0, 1000),
            'amount_subtotal' => $this->faker->randomFloat(2, 0, 1000),
            'amount_total' => $this->faker->randomFloat(2, 0, 1000),
            'stripe_checkout_session_id' => $this->faker->uuid,
            'status' => 'pending',
            'shipping_address' => [
                'line1' => $this->faker->streetAddress,
                'line2' => $this->faker->secondaryAddress,
                'city' => $this->faker->city,
                'state' => $this->faker->state,
                'postal_code' => $this->faker->postcode,
                'country' => $this->faker->country,
            ],
            'billing_address' => [
                'line1' => $this->faker->streetAddress,
                'line2' => $this->faker->secondaryAddress,
                'city' => $this->faker->city,
                'state' => $this->faker->state,
                'postal_code' => $this->faker->postcode,
                'country' => $this->faker->country,
            ],

        ];
    }
}
