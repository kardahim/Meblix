@extends('layouts.master')    
@section('content')    
    <div class="container content-size" style="padding-bottom: 100px">
        @foreach ($products as $product)   
        <div class="row">    
            <div class="col-sm-6">    
                <img src="{{ $product['image_link'] }}" alt="{{ $product['name'] }}" class="detail-img">    
            </div>    
            <div class="col-sm-6">    
                <br><br>    
                <h2>{{ $product['name'] }}</h2>    
                <h3>Cena: {{ $product['price'] }}zł</h3>    
                <h4>Opis: {{ $product['description'] }}</h4>    
                <h4>Kategoria: {{ $product['category']->name }}</h4>    
                <br><br>    
                <form action="" method="POST">    
                    @csrf    
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">    
                    <button class="btn btn-primary">Dodaj do koszyka</button>    
                </form>    
                <br>    
                <button class="btn btn-success">Kup teraz</button>    
            </div>    
        </div> 
        @endforeach    
    </div>    
@endsection   