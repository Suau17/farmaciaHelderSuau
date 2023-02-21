@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<script src = "/clients/clients.js" defer></script>
</head>
<body>
	<h1>CRUD CLIENTS</h1>

	<div>
		<input type="text" id="clientDni">
		<input type="text" id="clientName">
		<input type = "text" id = "clientGender">
		<input type = "text" id = "clientTarja">
		<button id="saveButton" >Save</button>
	</div>

    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
    <button onClick="getClient()">Mostrar Clientes</button>

	<table>
		<thead>
			<tr>
				<th>id</th>
				<td>DNI</td>
                <td>Nom</td>
                <td>Gènere</td>
                <td>Targeta sanitaria</td>
			</tr>
		</thead>
	<tbody id="taula">			
	</tbody>
	<table>
	    <nav class = "mt-2">
        <ul id = 'pagination' class = 'pagination'>

        </ul>
    </nav>
	</table>

</body>
</html>
@endsection