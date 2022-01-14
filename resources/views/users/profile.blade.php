@extends('layouts.master')    
@section('content') 
<div class="content-size container offset-sm-4" style="padding-top:155px">    
    <div class="col-sm-7">    
        <div>
            {{-- first name --}}
            <div class="row cart-list"> 
                <div class="col-sm-6">      
                    <h2>Imię</h2>
                </div>
                <div class="col-sm-6">      
                    <h2>{{ $user->first_name }}</h2>      
                </div>        
            </div>
            {{-- last name --}}
            <div class="row cart-list"> 
                <div class="col-sm-6">      
                    <h2>Nazwisko</h2>      
                </div>
                <div class="col-sm-6">      
                    <h2>{{ $user->last_name }}</h2>      
                </div>        
            </div>
            {{-- email --}}
            <div class="row cart-list"> 
                <div class="col-sm-6">      
                    <h2>Adres email</h2>      
                </div>
                <div class="col-sm-6">      
                    <h2>{{ $user->email }}</h2>      
                </div>        
            </div>
            {{-- location --}}
            <div class="row cart-list"> 
                <div class="col-sm-6">      
                    <h2>Miejscowość</h2>      
                </div>
                <div class="col-sm-6">      
                    <h2>{{ $user->address->location }} {{ $user->address->postal_code }}</h2>      
                </div>        
            </div>
            {{-- address --}}
            <div class="row cart-list"> 
                <div class="col-sm-6">      
                    <h2>Adres</h2>      
                </div>
                <div class="col-sm-6">      
                    <h2>{{ $user->address->street }} {{ $user->address->house_number }}</h2>      
                </div>        
            </div>
        </div>    
    </div>    
</div> 
@endsection