@extends('plantilla')
@section('content')
<h1>Clients</h1>
<a href="/Treballador/formnew">Login Treballador</a>
<table border=1>
    <tr>
        <td>id</td>
        <td>DNI</td>
        <td>Nom</td>
        <td>gender</td>
        
    </tr>
    @foreach($Treballadors as $treballador)
        <tr>
            <td>{{ $treballador->id }}</td>
            <td>{{ $treballador->dni }}</td>
            <td>{{ $treballador->nom }}</td>
            <td>{{ $treballador->genere }}</td>
            
            <td>
                <a href="/Treballador/delete/{{ $treballador->id }}">Delete</a>
                <a href="/Treballador/update/{{ $treballador->id }}">Update</a>
            </td>
        </tr>
    @endforeach
</table>
{{ $Treballadors->links('pagination::bootstrap-4') }}
@endsection