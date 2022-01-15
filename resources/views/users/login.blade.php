@extends('layouts.master')
@section('content')
<div class="content-size container">
    @if(Session::has('loginError'))
        <div class="alert alert-danger">
            {{ Session::get('loginError') }}
        </div>
    @endif
    <form action="/login" method="POST">
        @csrf
        {{-- email address --}}
        <div class="form-group offset-4">
            <label for="exampleInputEmail1" style="font-weight:bold">Adres email</label>
            <input name="email" type="email" class="form-control col-sm-6 " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
        </div>
        {{-- password --}}
        <div class="form-group offset-4">
            <label for="exampleInputPassword1" style="font-weight:bold">Hasło</label>
            <input name="password" type="password" class="form-control col-sm-6" id="exampleInputPassword1" placeholder="Hasło">
        </div>
        {{-- submit button --}}
        <button type="submit" class="btn btn-primary offset-4">Zaloguj się</button>
    </form>
</div>
@endsection