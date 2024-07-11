<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      Product::factory(4)
          ->hasVariants(5)
          ->has(Category::factory(1))
          ->has(Image::factory(3)->sequence(fn(Sequence $sequence) => ['featured' => $sequence->index === 0]))
          ->create();

      // Create a user admin with password admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'crunchdev.ai@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
