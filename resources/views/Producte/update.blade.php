@extends('plantilla')
@section('content')
<h1>Update Producte</h1>
<form action="/Producte/update/{{ $Productes->id }}" method="post">
    @csrf
    Nom<input type="text" name="nom" value="{{ $Productes->nom}}"><br>
    Tipus<input type="text" name="tipus" value="{{$Productes->tipus}}"><br>
    
 
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