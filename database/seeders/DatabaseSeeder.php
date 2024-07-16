<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use function public_path;
use function storage_path;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // create a new directory for the images if it does not exist
        if (!File::exists(storage_path('app/public/images')))
            File::makeDirectory(storage_path('app/public/images'));

        // move images from public to storage
        $files = File::allFiles(public_path('images'));
        foreach ($files as $file) {
            File::copy($file->getPathname(), storage_path('app/public/images/' . $file->getFilename()));
        }

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
