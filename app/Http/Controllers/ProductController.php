<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function search(Request $request)
    {

        $search = Product::with('category')
            ->where('name', 'like', '%' . $request->input('search_input') . '%')
            // i need filter category.name but i cant reach it
            // ->orWhere('name', 'like', '%' . $request->input('search_input') . '%')
            ->get();

        return view('products.search', ['products' => $search]);
    }

    public function catalog($id)
    {
        $products = Product::with('category')->where('category_id', $id)->get();

        // return dd($products);
        return view('products.category', ['products' => $products]);
    }

    public function addToCart(Request $request)
    {
        if ($request->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->product_id = $request->product_id;
            $cart->save();
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public static function cartItem()
    {
        $userId = Session::get('user')['id'];

        return Cart::where('user_id', $userId)->count();
    }
}
