@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producte</title>
    <script src="/productes/producte.js" defer>

    

</script>
<style>
    h1{
        text-align: center;
        margin-top: 3%;
    }
    .div2{
        text-align: center;
        padding-bottom: 5%;
    }

    .table{
        text-align: center;
        border: solid 1px;
        margin-top: 2%;
    }
    tr:hover{
        background-color: lightgrey;
    }
</style>
</head>

<body>
    <h1 >CRUD PRODUCTOS</h1>
    <div class="div2">
    <div>
        NOM:<input type="text" name="producteNom" id="producteNom">
        TIPUS:<input type="text" name="producteTipus" id="producteTipus">
        <button id="saveButton">save</button>
    </div>
    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
    <!-- <button onClick="getProducte()">Mostrar Productos</button> -->
    <table class="table">
        <thead style="border: solid 1px;">
            <tr style="border: solid 1px;">
                <th>id</th>
                <th>nom</th>
                <th>tipus</th>
                <th>Operacions</th>
            </tr>
        </thead>
        <tbody id="taula">

        </tbody>
    </table>
    </div>
    <nav class = "mt-2">
        <ul id = 'pagination' class = 'pagination'>

        </ul>
    </nav>

    </form>
</body>

</html>

    @endsection
