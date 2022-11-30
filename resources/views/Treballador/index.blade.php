@extends('plantilla')
@section('content')
<h1>Treballadors</h1>
<a href="/Treballador/formnew">Login Treballador</a>
<table border=1 class ="table">
<thead class="thead-dark">
    <tr>
        <td>id</td>
        <td>DNI</td>
        <td>Nom</td>
        <td>gender</td>
        
        
    </tr>
    </thead>
    <tbody>
    @foreach($Treballadors as $treballador)
        <tr>
            <td>{{ $treballador->id }}</td>
            <td>{{ $treballador->dni }}</td>
            <td>{{ $treballador->nom }}</td>
            <td>{{ $treballador->genere }}</td>
            
            
            <td>
                
                <a href="/Treballador/delete/{{ $treballador->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
                <a href="/Treballador/update/{{ $treballador->id }}"><button type="button" class="btn btn-primary">Update</button></a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $Treballadors->links('pagination::bootstrap-4') }}
@endsection