<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Treballador;
use App\Http\Resources\TreballadorResource as TreballadorResource;
use Validator;

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
       
        
        $Treballador= Treballador::all();
        $Treballador= Treballador::Paginate(10);
        
        $response = [
            'success' => true, 
            'message' => "Llista Treballadors recuperada",
            'data' => $Treballador, 
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
        
        //
        $input = $request->all();

        // Creem un validador de les dades enviades, i li passem les regles
        // que volem comprovar
        $validator = Validator::make($input, [
            'dni' => 'required|min:3',
            'nom' => 'required|min:3',
            'genere' => '',
        ]);

        // Si alguna dada no és correcta
        if($validator->fails()){

           $response = [
             'success' => false,
             'message' => "Alta incorrecta!",
             'data' => $validator->errors()->all(),
           ];
           // Retornem l'array convertit a JSON i el codi d'error 404 de
           //  HTTTP
           return response()->json($response, 404);     
        }

                
        $Treballador= Treballador::create($input);

        // Responem a la crida amb un tot ok!
        $response = [
           'success' => true,
           'data'    => $Treballador,
           'message' => "Alta correcta",

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
        try {
            //code...

        $Treballador = Treballador::findOrFail($id);
        
        $response = [
            'success' => true, 
            'message' => "Informacion Trabajador recuperada",
            'data' => $Treballador, 
        ];
  

        return response()->json($response, 200); 
        
    } catch (\Throwable $th) {
        $response = [
            'success' => false, 
            'message' => "Error al buscar el trabajador",
            'data' => $th, 
        ];
        return response()->json($response, 404);  
    }
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
        // );+
        $testDni =  preg_match('/^[0-9]{8,8}[A-Za-z]$/g',$request->dni);
        $validator = Validator::make($input, [
             'nom' => 'required | min:3 | max:20' ,
        ]);
        if($validator->fails() || !$testDni){
            $response = [
                'success' => true, 
                'message' => "errors de validacio",
                'data' => $validator->errors()->all(), 
            ];
      
            return response()->json($response, 404); 
        }
        try {
            //code...

        $Treballador = Treballador::findOrFail($id);
        $Treballador->dni = $request->dni;
        $Treballador->nom = $request->nom;
        $Treballador->genere = $request->genere;
        $Treballador->save();
        
        $response = [
            'success' => true, 
            'message' => "Informacion Trabajador actualizada con exito",
            'data' => $Treballador, 
        ];
  
        return response()->json($response, 200); 
    } catch (\Throwable $th) {
        $response = [
            'success' => false, 
            'message' => "Error al actualizar el trabajador",
            'data' => $th, 
        ];
        return response()->json($response, 404);  
    }
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
        try {
            //code...
      
        $Treballador = Treballador::findOrFail($id);
        $Treballador->delete();
        $response = [
            'success' => true, 
            'message' => "Trabajador eliminado"
        ];
  
        return response()->json($response, 200); 
    } catch (\Throwable $th) {
        $response = [
            'success' => false, 
            'message' => "Error al eliminar el trabajador",
            'data' => $th, 
        ];
        return response()->json($response, 404);  
    }
    }
}
