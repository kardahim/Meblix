<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:products,name',
                'price' => 'required|numeric',
                'image_link' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => "Nazwa produktu wymagana!",
                'name.unique' => "Produkt o tej nazwie już istnieje!",
                'price.required' => "Cena wymagana!",
                'price.numeric' => "To nie kwota!",
                'image_link.required' => "Link do zdjęcia jest wymagany!",
                'description.required' => "Opis jest wymagany!",
            ]
        );

        if ($validator->fails()) {
            Session::put('addProductError', $validator->getMessageBag()->toArray());
            return Redirect::back();
        } else {
            Session::forget('addProductError');
            $product = new Product;

            $product->name = $request->name;
            $product->price = $request->price;
            $product->image_link = $request->image_link;
            $product->description = $request->description;
            $product->category_id = $request->category;

            $product->save();

            return redirect(route("adminPanel", ['id' => 1]));
        }
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'image_link' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => "Nazwa produktu wymagana!",
                'price.required' => "Cena wymagana!",
                'price.numeric' => "To nie kwota!",
                'image_link.required' => "Link do zdjęcia jest wymagany!",
                'description.required' => "Opis jest wymagany!",
            ]
        );

        if ($validator->fails()) {
            Session::put('editProductError', $validator->getMessageBag()->toArray());
            return Redirect::back();
        } else {

            Session::forget('editProductError');
            $product = Product::where('id', $id)->first();
            $product->name = $request->name;
            $product->image_link = $request->image_link;
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->description = $request->description;

            $product->update();

            return redirect(route("adminPanel", ['id' => 1]));
        }
    }

    public function addNewCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:category,name',
            ],
            [
                'name.required' => "Nazwa kategorii wymagana!",
                'name.unique' => "Kategoria o tej nazwie już istnieje!",
            ]
        );
        if ($validator->fails()) {
            Session::put('addCategoryError', $validator->getMessageBag()->toArray());
            return Redirect::back();
        } else {
            Session::forget('addCategoryError');
            $category = new Category;

            $category->name = $request->name;

            $category->save();

            return redirect(route("adminPanel", ['id' => 2]));
        }
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => "Nazwa produktu wymagana!",
            ]
        );

        if ($validator->fails()) {
            Session::put('editCategoryError', $validator->getMessageBag()->toArray());
            return Redirect::back();
        } else {
            Session::forget('editCategoryError');

            $category = Category::find($id);
            $category->name = $request->name;

            $category->update();

            return redirect(route("adminPanel", ['id' => 2]));
        }
    }

    public function deleteCategory($id)
    {
        $product = Product::where('category_id', $id)->first();

        if ($product === null)
            Category::find($id)->delete();

        return redirect(route("adminPanel", ['id' => 2]));
    }
}
