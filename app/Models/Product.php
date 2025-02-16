<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Number;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'product_category_id'
    ];

    protected $appends = ['real_price', 'total_discount_percentage', 'clubcard_price', 'total', 'total_discount_with_clubcard'];

    protected function getRealPriceAttribute($value)
    {
        return (float) $this->price / 100;
    }

    protected function getClubcardPriceAttribute($value): string
    {
        $clubcardDiscount = Discount::whereHandle('clubcard')->first();

        $discount = ($this->real_price / 100) * $clubcardDiscount->discount_percentage;
        
        $total = $this->real_price - $discount;

        return Number::currency($total);
    }

    public function getTotalAttribute()
    {
        $totalDiscountPercentage = $this->discounts->sum('discount_percentage') + $this->productCategory->discounts->sum('discount_percentage');

        $price = $this->real_price;

        $discount = ($price / 100) * $totalDiscountPercentage;
        
        $total = $price - $discount;

        return Number::currency($total);
    }

    public function getTotalDiscountWithClubcardAttribute()
    {
        $totalDiscountPercentage = $this->discounts->sum('discount_percentage') + $this->productCategory->discounts->sum('discount_percentage');

        $clubcardDiscount = Discount::whereHandle('clubcard')->first();

        $price = $this->real_price;

        $discount = (($price / 100) * $totalDiscountPercentage) + (($price / 100) * $clubcardDiscount->discount_percentage);
        
        $total = $price - $discount;

        return Number::currency($total);
    }

    public function getTotalDiscountPercentageAttribute(): int
    {
        return $this->discounts->sum('discount_percentage') + $this->productCategory->discounts->sum('discount_percentage');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function discounts(): MorphToMany
    {
        return $this->morphToMany(Discount::class, 'discountable', 'discountables', 'discountable_id', 'discount_id');
    }
}
