<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->query();

        if($category_name = $request->input('category'))
        {
            $products = $products->whereHas('category', function (Builder $query) use ($category_name) {
                $query->where('name', $category_name);
            });
        }

        if($price = $request->input('price'))
        {
            $products = $products->where('price', $price);
        }

        return ProductResource::collection($products->get());
    }
}
