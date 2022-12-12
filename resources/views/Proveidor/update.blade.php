@extends('plantilla')
@section('content')
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="form-data" v-if="!submitted">
<h1>Update superhero</h1>
<form action="/Proveidor/update/{{ $Proveidor->id }}" method="post">
    @csrf
    <div class="forms-inputs mb-4">
    Nom<input type="text" name="nomE" value="{{ $Proveidor->nomE}}"><br>
</div>
<div class="forms-inputs mb-4">
    Pais <input type="text" name="pais" value="{{$Proveidor->pais}}"><br>
</div>
    
<div class="mb-3"> <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Update</button> </div>
</form>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@endsection