@extends('plantilla')
@section('content')
<h1>Login Client</h1>
<form action="/clients/save" method="POST">
    @csrf
   DNI<input type="text" name="dni" value="{{ old('dni') }}"><br>
    Name <input type="text" name="name" value="{{ old('name') }}"><br>
    Gender <select name="gender" value="{{ old('gender') }}">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br>
   Targeta Sanitaria <input type="text" name="targeta_sanitaria"><br>
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