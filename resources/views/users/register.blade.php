@extends('layouts.master')
@section('content')
<div class="content-size container" style="padding-top: 50px">
    @if(Session::has('registerError'))
    <div class="alert alert-danger">
        @foreach (Session::get('registerError') as $item)
        @foreach ($item as $error => $message)
            {{$message}}<br>
        @endforeach
    @endforeach
    </div>
    @endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        {{-- first name --}}
        <div class="form-group offset-4">
            <label for="name" style="font-weight:bold">Imię</label>
            <input class="form-control col-sm-6" type="text" placeholder="Imię" id="name" name="first_name">
        </div>
        {{-- last name --}}
        <div class="form-group offset-4">
            <label for="lname" style="font-weight:bold">Nazwisko</label>
            <input class="form-control col-sm-6" type="text" placeholder="Nazwisko" id="lname" name="last_name">
        </div>
        {{-- email address --}}
        <div class="form-group offset-4">
            <label for="exampleInputEmail1" style="font-weight:bold">Adres email</label>
            <input name="email" type="text" class="form-control col-sm-6" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
        </div>
        {{-- password --}}
        <div class="form-group offset-4">
            <label for="exampleInputPassword1" style="font-weight:bold">Hasło</label>
            <input name="password" type="password" class="form-control col-sm-6" id="exampleInputPassword1" placeholder="Hasło">
        </div>
        {{-- street --}}
        <div class="form-group offset-4">
            <label for="street" style="font-weight:bold">Ulica</label>
            <input class="form-control col-sm-6" type="text" placeholder="Ulica" id="street" name="street">
        </div>
        {{-- house number --}}
        <div class="form-group offset-4">
            <label for="hn" style="font-weight:bold">Numer domu</label>
            <input class="form-control col-sm-6" type="text" placeholder="Numer domu" id="hn" name="house_number">
        </div>
        {{-- postal code --}}
        <div class="form-group offset-4">
            <label for="pc" style="font-weight:bold">Kod pocztowy</label>
            <input class="form-control col-sm-6" type="text" placeholder="Kod pocztowy" id="pc" name="postal_code">
        </div>
        {{-- location --}}
        <div class="form-group offset-4">
            <label for="city" style="font-weight:bold">Miejscowość</label>
            <input class="form-control col-sm-6" type="text" placeholder="Miejscowość" id="city" name="city">
        </div>
        {{-- submit button --}}
        <button type="submit" class="btn btn-primary offset-4" style="margin-bottom:24px">Zarejestruj się</button>
    </form>
</div>
@endsection