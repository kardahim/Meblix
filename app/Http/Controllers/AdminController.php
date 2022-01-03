<?php

namespace App\Http\Controllers;

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
            return view('admins.index', ['items' => $products]);
        else if ($id == 2)
            return view('admins.index', ['items' => $categories]);
        else if ($id == 3)
            return view('admins.index', ['items' => $users]);
    }
}
