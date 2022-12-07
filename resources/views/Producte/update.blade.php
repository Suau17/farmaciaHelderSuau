@extends('plantilla')
@section('content')
<h1>Update superhero</h1>
<form action="/Client/update/{{ $Clients->id }}" method="post">
    @csrf
    Dni<input type="text" name="dni" value="{{ $Clients->dni}}"><br>
    Nom <input type="text" name="nom" value="{{$Clients->nom}}"><br>
    
 
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