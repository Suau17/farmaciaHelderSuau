@extends('plantilla')
@section('content')
<h1>Clients</h1>
<a href="/Client/formnew">Login Client</a>
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
    @foreach($Clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->dni }}</td>
            <td>{{ $client->nom }}</td>
            <td>{{ $client->genere }}</td>
            <td>{{ $client->tarja_sanitaria}}</td>
            
            <td>
                
                <a href="/Client/delete/{{ $client->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
                <a href="/Client/update/{{ $client->id }}"><button type="button" class="btn btn-primary">Update</button></a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $Clients->links('pagination::bootstrap-4') }}
@endsection