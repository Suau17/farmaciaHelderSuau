@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producte</title>

    <script src="/proveidor/hola.js" defer></script>

</head>

<body>
    <h1>CRUD PROVEIDORS</h1>
    <div>
        <input type="text" name="inputNom" id="inputNom">
        <input type="text" name="inputPais" id="inputPais">
        <button id="saveButton">save</button>
    </div>
    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
    <button onClick="getProducte()">Mostrar Productos</button>
    <table>
        <thead>
            <tr>
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
</body>

</html>
@endsection