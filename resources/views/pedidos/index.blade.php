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
</style>

<body>
    <h1>CRUD PROVEIDORS</h1>
    <div>
        <button id="btnCreate" onclick="createPedidos()">Crear Pedido</button>
        <button id="btnList" onclick="viewPedidos()">Ver Pedidos</button>
    </div>

    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>

    <div id="formPedidos" class="d-none">
        <form id="createPedido">
            <input type="text">
        </form>
    </div>

    <div id='divPedidos'>
        <table class="table">
            <thead style="border: solid 1px;">
                <tr style="border: solid 1px;">
                    <th>id</th>
                    <th>nom</th>
                    <th>país</th>
                    <th>Operacions</th>
                </tr>
            </thead>
            <tbody id="taula">

            </tbody>
        </table>
    </div>

    </form>
    <nav class="mt-2">
        <ul id='pagination' class='pagination'>

        </ul>
    </nav>
    <script src="/PedidosJS/operaciones.js" defer />
</body>

</html>
@endsection
