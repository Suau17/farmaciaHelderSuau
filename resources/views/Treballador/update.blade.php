@extends('plantilla')
@section('content')
<h1>Update superhero</h1>
<form action="/Treballador/update/{{ $Treballadors->id }}" method="post">
    @csrf
    Dni<input type="text" name="dni" value="{{ $Treballadors->dni}}"><br>
    Nom <input type="text" name="nom" value="{{$Treballadors->nom}}"><br>
    Gender <select name="genere" value="{{$Treballadors->genere }}">
        <option value="masculi">Male</option>
        <option value="femeni">Female</option>
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