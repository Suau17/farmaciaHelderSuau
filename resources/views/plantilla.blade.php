<html lang="es">
  <head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title></title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>
  <body class="p-3 mb-2 bg-light text-dark">
    
    <div>
    <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" href="{{ url('/') }}">home</a>
  </li>
  @if(Auth::user()->is_admin)   
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/Client') }}">Client</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/Treballador') }}">Treballador</a>
  </li>
  @endif
  <li class="nav-item">
    <a class="nav-link " href="{{ url('/Producte') }}">Producte</a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="{{ url('/Proveidor') }}">Proveidor</a>
  </li>


  
  @guest
    @if (Route::has('login'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
    @endif

    
    @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    @endguest
  
</ul>
      
     
    </div>
    <h1>FARMACIA</h1>
    <div class="container"> 
        @yield('content')
    </div>
    

  </body>
</html>