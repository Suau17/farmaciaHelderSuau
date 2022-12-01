<html lang="es">
  <head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title></title>
    <!-- Scripts -->
   
  </head>
  <body class="p-3 mb-2 bg-light text-dark">
    
    <div>
    <ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" href="{{ url('/') }}">home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/Client') }}">Client</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/Treballador') }}">Treballador</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ url('/Producte') }}">Producte</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{ url('/Proveidor') }}">Proveidor</a>
  </li>
  
</ul>
      
     
    </div>
    <h1>FARMACIA</h1>
    <div class="container"> 
        @yield('content')
    </div>
    

  </body>
</html>