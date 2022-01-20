<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // disable login and register to logged users
        if (($request->path() == "login" || $request->path() == "rejestracja") && $request->session()->has('user')) {
            return redirect('/');
        }

        // disable admin to logged off users
        if ($request->is('admin/*') && (!$request->session()->has('user'))) {
            return redirect('/');
        }

        // disable admin to users with status !== 1
        if ($request->is('admin/*') && $request->session()->has('user') && session('user')['status'] !== 1) {
            return redirect('/');
        }

        // disable admin to logged off users
        if ($request->path() == "koszyk" && (!$request->session()->has('user'))) {
            return redirect('/');
        }

        // disable profile to logged off users
        if ($request->is('profil/*') && (!$request->session()->has('user'))) {
            return redirect('/');
        }

        // delete session when change url
        if ($request->path() !== "login" && $request->session()->has('loginError')) {
            Session::forget('loginError');
        }
        if ($request->path() !== "rejestracja" && $request->session()->has('registerError')) {
            Session::forget('registerError');
        }
        if ($request->path() !== "admin/1" && $request->session()->has('addProductError')) {
            Session::forget('addProductError');
        }
        if ($request->path() !== "admin/2" && $request->session()->has('addCategoryError')) {
            Session::forget('addCategoryError');
        }
        if (!$request->is('admin/edytujprodukt/*') && $request->session()->has('editProductError')) {
            Session::forget('editProductError');
        }
        if (!$request->is('admin/edytujkategorie/*') && $request->session()->has('editCategoryError')) {
            Session::forget('editCategoryError');
        }

        return $next($request);
    }
}
