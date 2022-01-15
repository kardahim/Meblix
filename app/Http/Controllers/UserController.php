<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            Session::put('loginError', 'Login i hasło są wymagane!');
            return Redirect::back();
        }

        $user =  User::where(['email' => $request->email])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            Session::put('loginError', 'Login lub hasło jest niepoprawne!');
            return Redirect::back();
        } else {
            $request->session()->put('user', $user);
            return redirect('/');
        }
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 0;

        $address = new Address;
        $address->street = $request->street;
        $address->house_number = $request->house_number;
        $address->postal_code = $request->postal_code;
        $address->location = $request->city;

        // searched address
        $sa = Address::where('street', $address->street)
            ->where('house_number', $address->house_number)
            ->where('postal_code', $address->postal_code)
            ->where('location', $address->location)
            ->first();

        if ($sa === null) {
            $address->save();

            $sa = Address::where('street', $address->street)
                ->where('house_number', $address->house_number)
                ->where('postal_code', $address->postal_code)
                ->where('location', $address->location)
                ->first();

            $user->address_id = $sa->id;
        } else {
            $user->address_id = $sa->id;
        }

        $user->save();

        return redirect('/login');
    }

    public function profile($id, Request $request)
    {
        if ($request->is('profil/*') && $request->session()->has('user') && session('user')['status'] !== 1 && session('user')['id'] != $id) {
            // dd(session('user'));
            return redirect('/');
        }

        $user = User::with('address')->where('id', $id)->first();
        return view('users.profile', ['user' => $user]);
    }
}
