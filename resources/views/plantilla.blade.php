<html lang="es">
  <head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Farmacia</title>
  </head>
  <body>
    <div>
      <a href="{{ url('/') }}">Home</a>
      <a href="{{ url('/Client') }}">Clients</a>
      <a href="{{ url('/Treballador') }}">Treballador</a>
     
    </div>

    <div class="container"> 
        @yield('content')
    </div>
    <h1>FARMACIA</h1>

  </body>
</html>