<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use function array_search;
use function array_values;
use function dd;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
// public $categories = [
//            'Clothing' => [
//                'Footwear',
//                'Accessories',
//                'Tops',
//                'Bottoms',
//            ],
//            'Electronics' => [
//                'Smartphones',
//                'Laptops',
//                'Headphones',
//                'Smartwatches',
//            ],
//            'Books' => [
//                'Fiction',
//                'Non-Fiction',
//                'Children',
//                'Science',
//            ],
//            'Home & Garden' => [
//                'Furniture',
//                'Kitchen',
//                'Bedroom',
//                'Bathroom',
//            ],
// ];

public $categories = [ 'Footwear', 'Accessories', 'Tops', 'Bottoms', 'Smartphones', 'Laptops', 'Headphones', 'Smartwatches', 'Fiction', 'Non-Fiction', 'Children', 'Science', 'Furniture', 'Kitchen', 'Bedroom', 'Bathroom'];
public $parentCategories = ['Clothing', 'Electronics', 'Books', 'Home & Garden'];
    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
               $parent_id = (int)floor(array_search($category->name, $this->categories) / 4);
                $parent = Category::firstOrCreate([
                    'name' =>   $this->parentCategories [$parent_id] ,
                    'parent_id' => null,
                ]);
                $category->update([
                    'parent_id' => $parent->id,
                ]);



        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'name' => $this->faker->unique()->randomElement($this->categories),
            'parent_id' => null
        ];

//        // create 4 parent categories with each parent has 4 children
//        $categories = [
//            'Clothing' => [
//                'Footwear',
//                'Accessories',
//                'Tops',
//                'Bottoms',
//            ],
//            'Electronics' => [
//                'Smartphones',
//                'Laptops',
//                'Headphones',
//                'Smartwatches',
//            ],
//            'Books' => [
//                'Fiction',
//                'Non-Fiction',
//                'Children',
//                'Science',
//            ],
//            'Home & Garden' => [
//                'Furniture',
//                'Kitchen',
//                'Bedroom',
//                'Bathroom',
//            ],
//        ];
//
//
//        $category = $this->faker->unique()->randomElement(array_keys($categories));
//        $parent = Category::create([
//            'name' => $category,
//            'parent_id' => null,
//        ]);
//
//        //create children
//        foreach ($categories[$category] as $child) {
//            Category::create([
//                'name' => $child,
//                'parent_id' => $parent->id,
//            ]);
//        }
//
//        return [];


    }


}
