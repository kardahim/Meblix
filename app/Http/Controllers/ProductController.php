<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('id', '<', 5)->get();
        return view('index', ['products' => $products]);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $category_name = Category::find($product->category_id)->name;

        return view('products.detail', ['product' => $product, 'category_name' => $category_name]);
    }
}
