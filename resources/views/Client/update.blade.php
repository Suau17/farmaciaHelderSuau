@extends('plantilla')
@section('content')
<h1>Update superhero</h1>
<form action="/Client/update/{{ $Clients->id }}" method="post">
    @csrf
    Dni<input type="text" name="dni" value="{{ $Clients->dni}}"><br>
    Nom <input type="text" name="nom" value="{{$Clients->nom}}"><br>
    Gender <select name="genere" value="{{$Clients->genere }}">
        <option value="masculi">Male</option>
        <option value="femeni">Female</option>
    </select><br>
    Targeta Sanitaria <input type="text" name="tarja_sanitaria" value="{{$Clients->tarja_sanitaria }}"><br>
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