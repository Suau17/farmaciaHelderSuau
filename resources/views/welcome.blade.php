@extends('plantilla')

@section('content')
<script>
    function cookieExiste(nombreCookie) {
  var cookies = document.cookie.split(";"); // Divide todas las cookies en un array
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim(); // Elimina espacios en blanco
    if (cookie.indexOf(nombreCookie + "=") === 0) { // Comprueba si la cookie especificada existe
      return true;
    }
  }
}
    async function getToken() {

    // Llamando a la función cookieExiste con el nombre de la cookie que deseas buscar
    if (!cookieExiste("token")) {
        
        try {
        let URL = 'http://localhost:8000/token'

        const response = await fetch(URL, {
            method: 'GET',
            headers: {
                'Accept': 'aplication/json'
            }
        });
        const data = await response.json();
        console.log(data)

        if (response.ok) {

            let token = data.token.split("|");
            console.log(token[1])
            document.cookie = "token=" + token[1];

            // También puedes establecer una cookie con un tiempo de expiración


            // Para obtener el valor de una cookie, puedes usar la propiedad "cookie" del objeto "document"
            var miCookie = document.cookie;
            console.log(miCookie);
        } else {

        }
    } catch (error) {
        console.log(error)
    }
    } else {
        console.log("La cookie existe");
    }
   
}
    
    getToken()
</script>
<div class="text-white">
    <div class="card-header">
    </div>
    <img class="mx-auto d-block" src="/img/FARMACIA.png" alt="Card image cap">
    <div class="card-body">
    </div>
    <div class="card-footer">
    </div>
</div>

@endsection