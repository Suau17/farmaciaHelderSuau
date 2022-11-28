@extends('plantilla')
@section('content')
<h1>Clients</h1>
<a href="/Client/formnew">Login Client</a>
<table border=1>
    <tr>
        <td>id</td>
        <td>DNI</td>
        <td>Nom</td>
        <td>gender</td>
        <td>tarjeta_sanitaria</td>
        
    </tr>
    @foreach($Clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->dni }}</td>
            <td>{{ $client->nom }}</td>
            <td>{{ $client->genere }}</td>
            <td>{{ $client->tarja_sanitaria}}</td>
            
            <td>
                <a href="/Client/delete/{{ $client->id }}">Delete</a>
                <a href="/Client/update/{{ $client->id }}">Update</a>
            </td>
        </tr>
    @endforeach
</table>
{{ $Clients->links('pagination::bootstrap-4') }}
@endsection