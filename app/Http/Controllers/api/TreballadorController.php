<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TreballadorController extends Controller
{
   //
    // //
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Mostrar fins a un màxim de 10 els treballadors de la farmàcia
    public function index()
    {
        $Treballadors= Treballador::all();
        $Treballadors= Treballador::Paginate(10);
        
        $response = [
            'success' => true, 
            'message' => "Llista Treballadors recuperada",
            'data' => $Treballadors, 
        ];
  

        return response()->json($response, 200);           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Emmagatzemar treballadors a la base de dades
    public function store(Request $request)
    {    
        $Treballador = new Treballador;
        $Treballador->dni = $request->dni;
        $Treballador->nom = $request->nom;
        $Treballador->genere = $request->genere;
        $Treballador->save();
        $response = [
            'success' => true, 
            'message' => "Informacion Trabajador recuperada",
            'data' => $Treballador, 
        ];
        return response()->json($response, 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Treballador = Treballador::findOrFail($id);
        
        $response = [
            'success' => true, 
            'message' => "Informacion Trabajador recuperada",
            'data' => $Treballador, 
        ];
  

        return response()->json($response, 200);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Actualitzar els treballadors a la base de dades
    public function update(Request $request, $id)
    {
        // $request->validate(
        //     [ 'name' => 'required | min:3 | max:20' ]
        // );
        
        $Treballadors = Treballador::findOrFail($id);
        $Treballadors->dni = $request->dni;
        $Treballadors->nom = $request->nom;
        $Treballadors->genere = $request->genere;
        $Treballadors->save();
        
        $response = [
            'success' => true, 
            'message' => "Informacion Trabajador actualizada con exito",
            'data' => $Treballadors, 
        ];
  

        return response()->json($response, 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Eliminar els treballadors de la base de dades
    public function destroy($id)
    {
        $Treballador = Treballador::findOrFail($id);
        $Treballador->delete();
        $response = [
            'success' => true, 
            'message' => "Trabajador eliminado"
        ];
  

        return response()->json($response, 200); 
    }
}
