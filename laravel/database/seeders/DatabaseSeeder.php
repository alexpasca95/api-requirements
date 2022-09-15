<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products  = json_decode('[ { "sku": "000001", "name": "Full coverage insurance", "category": "insurance", "price": 89000 }, { "sku": "000002", "name": "Compact Car X3", "category": "vehicle", "price": 99000 }, { "sku": "000003", "name": "SUV Vehicle, high end", "category": "vehicle", "price": 150000 }, { "sku": "000004", "name": "Basic coverage", "category": "insurance", "price": 20000 }, { "sku": "000005", "name": "Convertible X2, Electric", "category": "vehicle", "price": 250000 } ]');

        foreach($products as $product)
        {
            $product = (object) $product;

            $category = ProductCategory::firstOrCreate([
                'name' => $product->category, 
                'discount' => $product->category == 'insurance' ? 30 : 0
            ]);

            $category->products()->create([
                'sku' => $product->sku,
                'name' => $product->name,
                'discount' => $product->sku == '000003' ? 15 : 0,
                'price' => $product->price
            ]);
        }
    }
}