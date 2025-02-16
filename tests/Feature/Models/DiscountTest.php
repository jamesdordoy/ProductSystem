<?php

namespace Tests\Feature\Models;

use App\Models\Discount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\ProductCategory;
use Tests\TestCase;

class DiscountTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_discount_can_relate_to_a_product(): void
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
        ]);

        $discount = Discount::factory()->create();

        $discount->discountableProducts()->attach($product);

        $this->assertCount(1, $discount->discountableProducts);
    }

    public function test_a_discount_can_relate_to_a_category(): void
    {
        $category = ProductCategory::factory()->create();

        $discount = Discount::factory()->create();

        $discount->discountableCategories()->attach($category);

        $this->assertCount(1, $discount->discountableCategories);
    }
}
