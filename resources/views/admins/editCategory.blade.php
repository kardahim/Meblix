@extends('layouts.master')    
@section('content') 
<div class="content-size" style="padding-left: 50px; padding-top:0px">
    <div class="col-sm-11">    
        <div class="popular-wrapper">
            <div class="row cart-list">
                <div class="col-sm-6"><h3>Nazwa kategorii</h3></div>
            </div>
            @if(Session::has('editCategoryError'))
            <div class="alert alert-danger">
                @foreach (Session::get('editCategoryError') as $item)
                    @foreach ($item as $error => $message)
                        {{$message}}<br>
                    @endforeach
                @endforeach
            </div>  
            @endif   
            {{-- form --}}
            <form class="row cart-list" method="POST" action="{{ route('confirmEditCategory',['id'=>$category['id']]) }}">
                @csrf
                <div class="col-sm-8">
                    <input class="form-control col-sm-6" type="text" placeholder="Nazwa" id="name" name="name" value="{{$category['name']}}">
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Potwierdź</button>
                </div>
            </form>
            {{-- products --}}
            @foreach ($products as $item)    
            <div class="row cart-list"> 
                {{-- image --}}
                <div class="col-sm-2">    
                    <a href="{{ route('detail', ['id' => $item->id]) }}">    
                        <img src="{{ $item->image_link }}" alt="{{ $item->name }}" class="popular-img">    
                    </a>    
                </div> 
                {{-- description --}}
                <div class="col-sm-4">    
                    <div>    
                        <h2>{{ $item->name }}</h2>    
                        <h5>{{ $item->description }}</h5>    
                    </div>    
                </div>
                {{-- price --}}
                <div class="col-sm-2">
                    <br><br>
                    <h2>{{ $item->price }} zł</h2> 
                </div> 
            </div>    
            @endforeach
        </div>    
    </div>    
</div>  
@endsection