<nav class="navbar navbar-expand-lg navbar-light bg-light">
  {{-- logo --}}
  <a class="navbar-brand" href="/">Meblix</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      {{-- landing page --}}
      <li class="nav-item active">
        <a class="nav-link" href="/">Główna <span class="sr-only">(current)</span></a>
      </li>
      {{-- all products --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Katalog
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      {{-- searchbar --}}
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </li>
    </ul>
    {{-- user session --}}
    <ul class="navbar-nav">
      @if (Session::has('user'))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Session::get('user')['first_name'] }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/logout">Wyloguj się</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Profil</a>
        </div>
      </li> 
      @else
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Konto
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/login">Zaloguj się</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Zarejestruj się</a>
        </div>
      </li> 
      @endif
      {{-- Cart --}}
      <li class="nav-item active">
        <a class="nav-link" href="/">Koszyk(0)</a>
      </li>
    </ul>
  </div>
</nav>