@extends('plantilla')
@section('content')
<h1>Login Client</h1>
<form action="/Client/save" method="POST">
    @csrf
   DNI<input type="text" name="dni" value="{{ old('dni') }}"><br>
    Name <input type="text" name="nom" value="{{ old('nom') }}"><br>
    Gender <select name="genere" value="{{ old('genere') }}">
        <option value="masculi">Male</option>
        <option value="femeni">Female</option>
    </select><br>
   Targeta Sanitaria <input type="text" name="tarja_sanitaria"><br>
    <input type="submit" value="Create">
</form> 
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif 

@endsection