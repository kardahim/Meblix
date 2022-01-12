@extends('layouts.master')    
@section('content') 
<div class="content-size" style="padding-left: 50px; padding-top:0px">
    <div class="col-sm-11">    
        <div class="popular-wrapper">
            {{-- admin pages --}}
            <div>
                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('adminPanel', ['id' => 1]) }}" style="margin-right: 25px">Produkty</a>
                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('adminPanel', ['id' => 2]) }}" style="margin-right: 25px">Kategorie</a>
                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('adminPanel', ['id' => 3]) }}" style="margin-right: 25px">Użytkownicy</a>
                <br><br>
            </div>
            {{-- page 1 --}}
            @if (Request::path() == "admin/1")
            {{-- header --}}
            <div class="row cart-list">
                <div class="col-sm-6"><h3>Produkt</h3></div>
                <div class="col-sm-2"><h3>Cena</h3></div>
                <div class="col-sm-2"><h3>Kategoria</h3></div>
                <div class="col-sm-1"><h3>Akcja</h3></div>
            </div>
            {{-- form --}}
            <form class="row cart-list" method="POST" action="{{ route('addNewProduct') }}">
                @csrf
                <div class="col-sm-2">
                    <br><br>
                    <input class="form-control col-sm-6" type="text" placeholder="Link" id="imgLink" name="image_link">
                </div>
                <div class="col-sm-4">
                    <input class="form-control col-sm-6" type="text" placeholder="Nazwa" id="name" name="name">
                    <br>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" placeholder="Opis"></textarea>
                </div>
                <div class="col-sm-2">
                    <br><br>
                    <input class="form-control col-sm-6" type="number" step="0.01" min="0" placeholder="Cena" id="price" name="price">
                </div>
                <div class="col-sm-2">
                    <br><br>
                    <select class="form-control" id="exampleFormControlSelect1" name="category">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-sm-1">
                    <br><br>
                    <button type="submit" class="btn btn-outline-success">Dodaj</button>
                </div>
            </form>
            {{-- products --}}
            @foreach ($items as $item)    
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
                <div class="col-sm-2">
                    <br><br>
                    <h2>{{ $item->category->name }}</h2> 
                </div> 
                {{-- buttons --}}
                <div class="col-sm-2">
                    <br><br>
                    <a class="btn btn-outline-warning my-2 my-sm-0" href="{{ route('editProduct',['id'=>$item->id]) }}" style="margin-right: 25px">Edytuj</a>
                    <a class="btn btn-outline-danger my-2 my-sm-0" href="{{ route('deleteProduct',['id'=>$item->id]) }}" style="margin-right: 25px">Usuń</a>
                </div>    
            </div>    
            @endforeach
            {{-- page 2 --}}
            @elseif(Request::path() == "admin/2")
            <div class="row cart-list">
                <div class="col-sm-4"><h3>Nazwa</h3></div>
                <div class="col-sm-4"><h3>Ilość produktów</h3></div>
                <div class="col-sm-3"><h3>Akcja</h3></div>
            </div>
            <form class="row cart-list" method="POST" action="{{ route('addNewCategory') }}">
                @csrf
                <div class="col-sm-8">
                    <input class="form-control col-sm-6" type="text" placeholder="Nazwa" id="name" name="name">
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-outline-success">Dodaj</button>
                </div>
            </form>
            @foreach ($items as $item)    
            <div class="row cart-list"> 
                {{-- name --}}
                <div class="col-sm-4">    
                    <div>    
                        <h2>{{ $item->name }}</h2>    
                    </div>    
                </div>
                {{-- name --}}
                <div class="col-sm-4">    
                    <div>    
                        <h2>{{ DB::table('products')->where('category_id',$item->id)->count() }}</h2>    
                    </div>    
                </div>
                {{-- buttons --}}
                <div class="col-sm-3">
                    <a class="btn btn-outline-warning my-2 my-sm-0" href="" style="margin-right: 25px">Edytuj</a>
                    <a class="btn btn-outline-danger my-2 my-sm-0" href="" style="margin-right: 25px">Usuń</a>
                </div>  
            </div>    
            @endforeach
            {{-- page 3 --}}
            @elseif(Request::path() == "admin/3")
            <div class="row cart-list">
                <div class="col-sm-2"><h2>Imię</h2></div>
                <div class="col-sm-2"><h2>Rola</h2></div>
                <div class="col-sm-3"><h2>Akcja</h2></div>
            </div>
            @foreach ($items as $item)    
            <div class="row cart-list"> 
                {{-- name --}}
                <div class="col-sm-2">     
                    <h2>{{ $item->first_name }} {{ $item->last_name }}</h2>     
                </div>
                {{-- status --}}
                <div class="col-sm-2">     
                    <h2>{{ $item->status==1 ? 'Administrator':'Użytkownik' }}</h2>     
                </div>
                {{-- buttons --}}
                <div class="col-sm-3">
                    <a class="btn btn-outline-primary my-2 my-sm-0" href="" style="margin-right: 25px">Profil</a>
                </div>  
            </div>    
            @endforeach
            @endif    
        </div>    
    </div>    
</div>  
@endsection