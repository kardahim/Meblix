@extends('layouts.master')
@section('content')
<div class="content-size container">
  {{-- slider --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            {{-- indicators --}}
            @for ($i = 0; $i < 4; $i++)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ $i==1?'active':'' }}"></li>
            @endfor
        </ol>
        <div class="carousel-inner">
            {{-- carousel items --}}
            @foreach ($products as $item)
            <div class="w-100 carousel-item {{ $item['id']==1?'active':'' }}">
                <img class="d-block custom-slider-image" src="{{ $item['image_link'] }}" alt="{{ $item['name'] }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $item['name'] }}</h5>
                    <p>{{ $item['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{-- popular products --}}    
    <div class="popular-wrapper">    
        <h3>Popularne teraz</h3>    
        <div class="popular-item">    
        @foreach ($products as $item)    
          <a href="detail/{{ $item['id'] }}">    
            <img src="{{ $item['image_link'] }}" alt="{{ $item['name'] }}" class="popular-img">    
            <h3>{{ $item['name'] }}</h3>    
          </a>    
        @endforeach    
        </div>    
      </div>    
</div>
@endsection
