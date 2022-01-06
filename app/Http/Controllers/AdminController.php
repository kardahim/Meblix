<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminPanel($id)
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        $users = User::all();

        if ($id == 1)
            return view('admins.index', ['items' => $products, 'categories' => $categories]);
        else if ($id == 2)
            return view('admins.index', ['items' => $categories]);
        else if ($id == 3)
            return view('admins.index', ['items' => $users]);
    }

    public function addNewProduct(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image_link = $request->image_link;
        $product->description = $request->description;
        $product->category_id = $request->category;

        $product->save();

        return redirect(route("adminPanel", ['id' => 1]));
    }

    public function deleteProduct($id)
    {
        $cart = Cart::where('product_id', $id)->first();
        if ($cart === null)
            Product::find($id)->delete();

        return redirect(route("adminPanel", ['id' => 1]));
    }
}
