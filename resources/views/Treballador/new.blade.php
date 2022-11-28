@extends('plantilla')
@section('content')
<h1>Login Treballador</h1>
<form action="/Treballador/save" method="POST">
    @csrf
   DNI<input type="text" name="dni" value="{{ old('dni') }}"><br>
    Name <input type="text" name="nom" value="{{ old('nom') }}"><br>
    Gender <select name="genere" value="{{ old('genere') }}">
        <option value="masculi">Male</option>
        <option value="femeni">Female</option>
    </select><br>
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