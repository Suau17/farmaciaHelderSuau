@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<h1>CRUD CLIENTS</h1>

	<div>
		<input type="text" id="clientNameInput">
		<button id="saveButton" >Save</button>
	</div>


	<div id="errors" class="mt-2 alert alert-danger" role="alert"></div>

	<table>
		<thead>
			<tr>
				<th>id</th>
				<td>DNI</td>
                <td>Nom</td>
                <td>gender</td>
                <td>tarjeta_sanitaria</td>
			</tr>
		</thead>
		<tbody id="taula">			
		</tbody>

	</table>

</body>
</html>
<script type="text/javascript">
    var rows = [];
    
</script>