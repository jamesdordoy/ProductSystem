<?php

namespace Tests\Feature\Models;

use App\Models\Discount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\ProductCategory;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_has_a_category(): void
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
        ]);

        $this->assertEquals($category->id, $product->productCategory->id);
    }

    public function test_a_product_can_have_discounts(): void
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
        ]);

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

        $product->discounts()->attach($discountA);
        $product->discounts()->attach($discountB);

        $this->assertCount(2, $product->discounts);
    }
}
