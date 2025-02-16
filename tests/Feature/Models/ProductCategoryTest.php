<?php

namespace Tests\Feature\Models;

use App\Models\Discount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\ProductCategory;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_cateogry_is_related_to_many_products(): void
    {
        $category = ProductCategory::factory()->create();
        $productA = Product::factory()->create([
            'title' => 'ProductA',
            'product_category_id' => $category->id,
        ]);

        $productB = Product::factory()->create([
            'title' => 'ProductB',
            'product_category_id' => $category->id,
        ]);

        $this->assertCount(2, $category->products);
    }

    public function test_a_category_can_have_discounts(): void
    {
        $category = ProductCategory::factory()->create();

        $discountA = Discount::factory()->create([
            'title' => 'DiscountA',
            'handle' =>'discount_a',
            'discount_percentage' => 20,
        ]);

        $discountB = Discount::factory()->create([
            'title' => 'DiscountB',
            'handle' =>'discount_b',
            'discount_percentage' => 20,
        ]);

        $category->discounts()->attach($discountA);
        $category->discounts()->attach($discountB);

        $this->assertCount(2, $category->discounts);
    }
}
