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
        // I must do own session because $errors in vievs don't work (bug from version 5)
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|regex:/[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,}/',
                'last_name' => 'required|regex:/[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,}/',
                'email' => 'required|unique:users,email|email',
                'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/',
                'street' => 'required|regex:/([A-ZĄĆĘŁŃÓŚŹŻ1-9][ ]?[a-ząćęłńóśźż 1-9]+)+/',
                'house_number' => 'required|regex:/[1-9]?[0-9][A-Z]?/',
                'postal_code' => 'required|regex:/[1-9]{2}-[1-9]{3}/',
                'city' => 'required|regex:/[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]{2,}/'
            ],
            [
                'first_name.required' => "Imię wymagane!",
                'first_name.regex' => "Imię z dużej litery oraz minimum 3 znaki!",
                'last_name.required' => "Nazwisko wymagane!",
                'last_name.regex' => "Nazwisko z dużej litery oraz minimum 3 znaki!",
                'email.required' => "Email wymagany!",
                'email.unique' => "Email zajęty!",
                'email.email' => "To nie jest email!",
                'password.required' => "Hasło wymagane!",
                'password.regex' => "Hasło musi mieć min 8 znaków, liczbę oraz znak specjalny",
                'street.required' => "Ulica wymagana!",
                'street.regex' => "Ulica niepoprawna",
                'house_number.required' => "Numer domu wymagany!",
                'house_number.regex' => "Błędny numer domu!",
                'postal_code.required' => "Kod pocztowy wymagany!",
                'city.required' => "Miejscowość wymagana!",
                'city.regex' => "Błędny kod pocztowy!",
                'city.regex' => "Miejscowość z dużej litery oraz minimum 3 znaki!",
            ]
        );

        if ($validator->fails()) {
            // return $validator->getMessageBag();
            Session::put('registerError', $validator->getMessageBag()->toArray());
            return Redirect::back();
        } else {

            Session::forget('registerError');
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
