@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <script src="/clients/client.js" defer>

    

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
    <h1 >CRUD CLIENTS</h1>
    <div class="div2">
    <div>
	    <input type="text" id="clientDni">
	    <input type="text" id="clientName">
		<input type = "text" id = "clientGender">
		<input type = "text" id = "clientTarja">
        <button id="saveButton">save</button>
    </div>
    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
    <!-- <button onClick="getClient()">Mostrar Productos</button> -->
    <table class="table">
        <thead style="border: solid 1px;">
            <tr style="border: solid 1px;">
				<th>id</th>
				<td>DNI</td>
                <td>Nom</td>
                <td>Gènere</td>
                <td>Targeta sanitaria</td>
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