@extends('plantilla')
@section('content')
<h1>Update superhero</h1>
<form action="/supers/update/{{ $supers->id }}" method="post">
    @csrf
    Dni<input type="text" name="dni" value="{{ $clients->dni}}"><br>
    Nom <input type="text" name="name" value="{{ $clients->name }}"><br>
    Gender <select name="gender" value="{{ $clients->gender }}">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br>
    Targeta Sanitaria <input type="text" nmae="targeta_sanitaria"><br>
    </select><br>
    <input type="submit" value="Update">
</form>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@endsection