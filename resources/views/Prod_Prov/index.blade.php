@extends('plantilla')
@section('content')
<h1>Proveidors</h1>
<!-- <a href="/Prod_Prov/formnew">Afegir Proveidor</a> -->
<table border=1 class ="table">
<thead class="thead-dark">
    <tr>
      
        <td>Prod_ID</td>
        <td>Prov_ID</td>
        
    </tr>
    </thead>
    <tbody>
    @foreach($Prod_Prov as $prod_prov)
        <tr>
            <td>{{ $prod_prov->proveidor_id }}</td>
            <td>{{ $prod_prov>producte_id }}</td>
           
            
            
            <td>
                
                <a href="/Prod_Prov/delete/{{ $prod_prov>id }}"><button type="button" class="btn btn-danger">Delete</button></a>
                <a href="/Prod_Prov/update/{{ $prod_prov->id }}"><button type="button" class="btn btn-primary">Update</button></a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $Prod_Prov->links('pagination::bootstrap-4') }}
@endsection