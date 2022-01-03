<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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

        return $next($request);
    }
}
