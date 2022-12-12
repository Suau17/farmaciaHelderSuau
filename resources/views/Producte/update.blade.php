@extends('plantilla')
@section('content')
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="form-data" v-if="!submitted">
<h1>Update Producte</h1>
<div class="forms-inputs mb-4">
<form action="/Producte/update/{{ $Productes->id }}" method="post">
    @csrf
    <div class="forms-inputs mb-4">
    Nom<input type="text" name="nom" value="{{ $Productes->nom}}"><br>
</div>
<div class="forms-inputs mb-4">
    Tipus<input type="text" name="tipus" value="{{$Productes->tipus}}"><br>
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