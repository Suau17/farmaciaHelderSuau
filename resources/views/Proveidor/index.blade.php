@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producte</title>

    <script src="/proveidor/operaciones.js" defer>
        
    </script>

</head>
<style>
    body{
        height: 100%;
    }
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
    .rowDataTD:hover{
        background-color: lightgrey;
        cursor: pointer
    }
    .mt-2{
       margin-bottom: 10%;
    }
</style>
<body>
    <h1>CRUD PROVEIDORS</h1>
    <div>
        <input type="text" name="inputNom" id="inputNom">
        <input type="text" name="inputPais" id="inputPais">
        <button id="saveButton">save</button>
    </div>
    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
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

    </form>
    <nav class = "mt-2">
        <ul id = 'pagination' class = 'pagination'>

        </ul>
    </nav>
</body>

</html>
@endsection