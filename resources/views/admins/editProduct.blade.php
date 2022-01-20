@extends('layouts.master')    
@section('content')    
    <div class="container content-size">
        @if(Session::has('editProductError'))
            <div class="alert alert-danger">
                @foreach (Session::get('editProductError') as $item)
                    @foreach ($item as $error => $message)
                        {{$message}}<br>
                    @endforeach
                @endforeach
            </div>  
        @endif      
        <div class="row">    
            <div class="col-sm-6">    
                <img src="{{ $product['image_link'] }}" alt="{{ $product['name'] }}" class="detail-img">      
            </div>
            <form class="col-sm-6" action="{{ route('confirmEditProduct',['id'=>$product['id']]) }}" method="POST">
                @csrf       
                <br><br>
                <input class="form-control col-sm-6" type="text" placeholder="Link do zdjecia" id="imgLink" name="image_link" value="{{ $product['image_link'] }}"> 
                <br> 
                <input class="form-control col-sm-6" type="text" placeholder="Nazwa" id="name" name="name" value="{{ $product['name'] }}">
                <br> 
                <input class="form-control col-sm-6" type="number" step="0.01" min="0" placeholder="Cena" id="price" name="price" value="{{ $product['price'] }}">
                <br>    
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Opis">{{ $product['description'] }}</textarea>
                <br>    
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{$item->id == $product['category_id']?'selected':''}}>{{ $item->name }}</option>
                @endforeach 
                </select> 
                <br>       
                <button class="btn btn-primary">Potwierdź</button>    
                <br>    
            </form>    
        </div>    
    </div>    
@endsection