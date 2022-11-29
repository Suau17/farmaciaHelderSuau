@extends('plantilla')
@section('content')
<h1>Proveidors</h1>
<a href="/Proveidor/formnew">Afegir Proveidor</a>
<table border=1 class ="table">
<thead class="thead-dark">
    <tr>
        <td>id</td>
        <td>DNI</td>
        <td>Nom</td>
        <td>gender</td>
        <td>tarjeta_sanitaria</td>
        
    </tr>
    </thead>
    <tbody>
    @foreach($Proveidors as $proveidor)
        <tr>
            <td>{{ $proveidor->id }}</td>
            
            <td>{{ $proveidor->nom }}</td>
            <td>{{ $proveidor->prodID}}</td>
            
            
            <td>
                
                <a href="/Proveidor/delete/{{ $proveidor->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
                <a href="/Proveidor/update/{{ $proveidor->id }}"><button type="button" class="btn btn-primary">Update</button></a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $Proveidors->links('pagination::bootstrap-4') }}
@endsection