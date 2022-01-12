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

    public function editProduct($id)
    {
        $product = Product::find($id);
        $category = Category::find($product->category_id)->first();
        $categories = Category::all();

        return view('admins.editProduct', ['product' => $product, 'category' => $category, 'categories' => $categories]);
    }

    public function confirmEditProduct($id, Request $request)
    {
        $product = Product::find($id)->first();

        $product->name = $request->name;
        $product->image_link = $request->image_link;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->description = $request->description;

        $product->update();

        return redirect(route("adminPanel", ['id' => 1]));
    }

    public function addNewCategory(Request $request)
    {
        $category = new Category;

        $category->name = $request->name;

        $category->save();

        return redirect(route("adminPanel", ['id' => 2]));
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();
        return view('admins.editCategory', ['category' => $category, 'categories' => $categories, 'products' => $products]);
    }

    public function confirmEditCategory($id, Request $request)
    {
        $category = Category::find($id)->first();
        $category->name = $request->name;

        $category->update();

        return redirect(route("adminPanel", ['id' => 2]));
    }
}
