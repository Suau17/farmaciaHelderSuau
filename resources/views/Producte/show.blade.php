@extends('plantilla')
@section('content')
<h1>{{$Producte->nomE}}</h1>
<table border=1 class ="table">
<thead class="thead-dark">
    <tr>
        <td>Nom Empresa</td>
        <td>Pais</td>  
    </tr>
    </thead>
    <tbody>
@foreach($Producte->proveidors as $proveidor)
<td>{{$proveidor->nomE}}</td>
<td>{{$proveidor->pais}}</td>

@endforeach
</tbody>
</table>

@endsection

