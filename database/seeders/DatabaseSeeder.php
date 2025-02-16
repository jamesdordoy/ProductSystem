<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $electronics = ProductCategory::factory()->create([
            'title' => 'Electronics'
        ]);

        $clothing = ProductCategory::factory()->create([
            'title' => 'E&E Clothing'
        ]);

        $books = ProductCategory::factory()->create([
            'title' => 'Books'
        ]);

        Product::factory()->create([
            'title' => 'iPhone 14',
            'description' => "The iPhone is a sleek, touchscreen smartphone by Apple, featuring advanced cameras, iOS, and seamless integration with Apple’s ecosystem.",
            'price' => 60000,
            'product_category_id' => $electronics->id,
        ]);

        Product::factory()->create([
            'title' => 'Samsung TV',
            'description' => "The Samsung TV offers high-definition displays, smart features, vibrant colors, and advanced connectivity, providing an immersive home entertainment experience.",
            'price' => 85000,
            'product_category_id' => $electronics->id,
        ]);

        Product::factory()->create([
            'title' => 'Stripped cardigan',
            'description' => "A stripped cardigan is a cozy, button-up sweater featuring bold horizontal or vertical stripes, offering style and warmth.",
            'price' => 1450,
            'product_category_id' => $clothing->id,
        ]);

        Product::factory()->create([
            'title' => 'Harrington jacket',
            'description' => "A Harrington jacket is a lightweight, casual zip-up jacket with a minimalist design, often found in everyday stores.",
            'price' => 4000,
            'product_category_id' => $clothing->id,
        ]);

        Product::factory()->create([
            'title' => 'Laravel for Nerds',
            'description' => "Laravel for Nerds is a detailed guide for developers, offering in-depth knowledge of Laravel’s features, best practices, and advanced techniques.",
            'price' => 3150,
            'product_category_id' => $books->id,
        ]);

        Product::factory()->create([
            'title' => 'Vue for Dummies',
            'description' => "Vue for Dummies is a beginner-friendly guide that simplifies learning Vue.js, covering core concepts, components, and building web applications.",
            'price' => 2000,
            'product_category_id' => $books->id,
        ]);

        $electronicsPromotion = Discount::factory()->create([
            'title' => 'Electronics Promotion',
            'handle' => 'electronics_promotion',
            'discount_percentage' => 10
        ]);

        $thing = $electronics->discounts()->attach($electronicsPromotion->id);

        $clubcard = Discount::factory()->create([
            'title' => 'Clubcard discount',
            'handle' => 'clubcard',
            'discount_percentage' => 5
        ]);
    }
}
