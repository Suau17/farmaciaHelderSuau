@extends('plantilla')
@section('content')
<h1>{{$Proveidor->nomE}}</h1>
<table border=1 class ="table">
<thead class="thead-dark">
    <tr>
        <td>Nom Producte</td>
        <td>Tipus</td>  
    </tr>
    </thead>
    <tbody>
@foreach($Proveidor->productes as $producte)
<td>{{$producte->nom}}</td>
<td>{{$producte->tipus}}</td>

@endforeach
</tbody>
</table>

@endsection

