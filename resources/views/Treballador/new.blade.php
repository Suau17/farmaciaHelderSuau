@extends('plantilla')
@section('content')
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="form-data" v-if="!submitted">
<h1>Login Treballador</h1>
<form action="/Treballador/save" method="POST">
    @csrf
    <div class="forms-inputs mb-4">
   DNI<input type="text" name="dni" value="{{ old('dni') }}"><br>
</div>
<div class="forms-inputs mb-4">
    Name <input type="text" name="nom" value="{{ old('nom') }}"><br>
</div>
<div class="forms-inputs mb-4">
    Gender <select name="genere" value="{{ old('genere') }}">
        <option value="masculi">Male</option>
        <option value="femeni">Female</option>
    </select><br>
</div>
<div class="mb-3">  <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Crear</button> </div>
</div>
</div>
</div>
</div>
</div>
</form> 
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif 

@endsection