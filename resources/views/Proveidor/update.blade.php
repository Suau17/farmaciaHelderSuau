@extends('plantilla')
@section('content')
<h1>Update superhero</h1>
<form action="/Proveidor/update/{{ $Proveidor->id }}" method="post">
    @csrf
    Nom<input type="text" name="nom" value="{{ $Proveidor->nom}}"><br>
    Pais <input type="text" name="pais" value="{{$Proveidor->pais}}"><br>
    
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