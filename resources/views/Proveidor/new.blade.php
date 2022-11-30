@extends('plantilla')
@section('content')

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5" id="form1">
                <div class="form-data" v-if="!submitted">
                <h1>Afegir Proveidor</h1>
<form action="/Proveidor/save" method="POST">
    @csrf
    <div class="forms-inputs mb-4">
    Name <input type="text" name="nom" value="{{ old('nom') }}"><br>
</div>
<div class="forms-inputs mb-4">
    Pais <input type="text" name="pais" value="{{ old('pais') }}"><br>
</div>
<div class="forms-inputs mb-4">
    Productes<input type="text" name="prod_ID" value="{{ old('prod_ID') }}"><br>
</div>


<div class="mb-3"> <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Login</button> </div>
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