@extends('plantilla')
@section('content')
<h1>Productes</h1>

<a href="/Producte/formnew">Afegir Producte</a>

<table border=1 class ="table">
<thead class="thead-dark">
    <tr>
        
        <td>id</td>
        <td>Nom</td>
        <td>tipus</td>
        
        
    </tr>
    </thead>
    <tbody>
    @foreach($Productes as $producte)
        <tr>
            <td>{{ $producte->id }}</td>          
            <td>{{ $producte->nom }}</td>
            <td>{{ $producte->tipus}}</td>

            <td>
                
                <a href="/Producte/delete/{{ $producte->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
                <a href="/Producte/update/{{ $producte->id }}"><button type="button" class="btn btn-primary">Update</button></a>
            </td>

        </tr>
    @endforeach
</tbody>
</table>
{{ $Productes->links('pagination::bootstrap-4') }}
@endsection