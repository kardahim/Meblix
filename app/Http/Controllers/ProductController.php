<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('id', '<', 5)->get();
        return view('index', ['products' => $products]);
    }
}
