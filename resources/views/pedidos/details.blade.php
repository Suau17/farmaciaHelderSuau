@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producte</title>



</head>
<style>
    body {
        height: 100%;
    }
    
    h1 {
        text-align: center;
        margin-top: 3%;
    }
    
    .div2 {
        text-align: center;
        padding-bottom: 5%;
    }
    
    .table {
        text-align: center;
        border: solid 1px;
        margin-top: 2%;
    }
    
    .rowDataTD:hover {
        background-color: lightgrey;
    }
    
    .mt-2 {
        margin-bottom: 10%;
    }

    .buscar{
        float:right;
        margin-bottom: 1%;
    }

    
    </style>

<body>
    <h1>Pedido</h1>

    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>

    <div class="info">
      <!-- Mostrar nombre de cliente o tarja sanitaria,
      precio total del pedido y hora del último update -->  

      </div id="displayInfo">
        
        </div>
    <div class="productos">
    <table class="table">

            <thead style="border: solid 1px;">
                <tr style="border: solid 1px;">
                    <th>id</th>
                    <th>Nom Producte</th>
                    <th>Tipus</th>
                    <th>Preu</th>
                </tr>
            </thead>
            <tbody id="taula">
                <div class="buscar">
                    <input type = "text" list='listProductes' placeholder = "Buscar el producte..." id="buscador"></input>
                    <button onClick = "agregar()">Agregar</button>
                </div>
            </tbody>

            </table>
    </div>

    <datalist id="listProductes">
        
    </datalist>


<script src="/PedidosJS/detailsprova.js" defer></script>
</body>

</html>
@endsection