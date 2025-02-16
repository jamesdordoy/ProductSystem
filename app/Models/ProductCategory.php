<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function discounts(): MorphToMany
    {
        return $this->morphToMany(Discount::class, 'discountable', 'discountables', 'discountable_id', 'discount_id');
    }
}
