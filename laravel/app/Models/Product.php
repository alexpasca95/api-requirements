<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'sku', 'name', 'discount', 'price'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getFinalPriceAttribute()
    {
        if($discount = $this->getDiscount()) 
            return intval($discount / 100 * $this->price);
        
        return $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if($discount = $this->getDiscount()) 
            return $discount . '%';
        
        return null;
    }

    protected function getDiscount()
    {
        return $this->discount ? $this->discount : $this->category->discount;
    }
}
