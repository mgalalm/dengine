<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => $this->faker->unique()->randomElement([
                'images/image1.jpg',
                'images/image2.jpg',
                'images/image3.jpg',
                'images/image4.jpg',
                'images/image5.jpg',
                'images/image6.jpg',
                'images/image7.jpg',
                'images/image8.jpg',
                'images/image9.jpg',
                'images/image10.jpg',
                'images/image11.jpg',
                'images/image12.jpg',
            ]),
        ];
    }
}
