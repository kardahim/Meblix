@extends('layouts.master')    
@section('content')    
<div class="content-size" style="padding-left: 50px; padding-top:50px">    
    <div class="col-sm-11">    
        <div class="popular-wrapper">      
            @foreach ($products as $item)    
            <div class="row cart-list"> 
                {{-- image --}}
                <div class="col-sm-2">    
                    <a href="{{ route('detail', ['id' => $item->product->id]) }}">    
                        <img src="{{ $item->product->image_link }}" alt="{{ $item->product->name }}" class="popular-img">    
                    </a>    
                </div> 
                {{-- description --}}
                <div class="col-sm-4">    
                    <div>    
                        <h2>{{ $item->product->name }}</h2>    
                        <h5>{{ $item->product->description }}</h5>    
                    </div>    
                </div>
                {{-- buttnos --}}    
                <div class="col-sm-3">
                    <br><br>
                    <button class="btn btn-warning">-</button>
                    <input type="number" value="{{ $item->amount }}" disabled>
                    <button class="btn btn-warning">+</button>   
                    <button class="btn btn-danger">X</button> 
                </div>
                {{-- price --}}
                <div class="col-sm-3">
                    <br><br>
                    <h2>{{ $item->product->price * $item->amount }} zł</h2> 
                </div>     
            </div>    
            @endforeach    
        </div>    
    </div>    
</div>    
@endsection 