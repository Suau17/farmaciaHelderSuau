<h1>{{$Proveidor->nomE}}</h1>
@foreach($Proveidor->productes as $producte)
{{$producte->nom}}
{{$producte->tipus}}
@endforeach