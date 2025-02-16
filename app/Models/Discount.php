<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'handle',
        'discount_percentage'
    ];
 
    public function discountableCategories(): MorphToMany
    {
        return $this->morphedByMany(ProductCategory::class, 'discountable', 'discountables', 'discount_id', 'discountable_id');
    }

    public function discountableProducts(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'discountable', 'discountables', 'discount_id', 'discountable_id');
    }
}
