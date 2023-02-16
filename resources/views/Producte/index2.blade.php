@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producte</title>
    <script src = "/productes/productes2.js" defer>



</script>
</head>

<body>
    <h1>CRUD PRODUCTOS</h1>
    <div>
        <input type="text" name="producteNom" id="producteNom">
        <input type="text" name="producteTipus" id="producteTipus">
        <button id="saveButton">save</button>
    </div>
    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
    <!-- <button onClick="getProducte()">Mostrar Productos</button> -->
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>tipus</th>
                <th>Operacions</th>
            </tr>
        </thead>
        <tbody id="taula">

        </tbody>
    </table>
    <nav class = "mt-2">
        <ul id = 'pagination' class = 'pagination'>

        </ul>
    </nav>

    </form>
</body>

</html>

    @endsection
