<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource as ClientResource;

use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //code...
        
        $Clients= Client::all();
        $Clients= Client::Paginate(10);
        
        $response = [
            'success' => true, 
            'message' => "Llista clients recuperada",
            'data' => $Clients, 
        ];
  
        return response()->json($response, 200);  

    } catch (\Throwable $th) {
        $response = [
            'success' => false, 
            'message' => "Error al buscar todos los clientes",
            'data' => $th, 
        ];
        return response()->json($response, 404);  
    }    
}   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // En $input guardem totes les dades que s'han enviat via POST
        $input = $request->all();

        // Creem un validador de les dades enviades, i li passem les regles
        // que volem comprovar
        $validator = Validator::make($input, [
          'dni' => 'required|min:0',
          'nom' => 'required|max:20',
          'genere' => 'required',
          'tarja_sanitaria' => 'required|max:25',
        ]);

        // Si alguna dada no és correcta
        if($validator->fails()){

           $response = [
             'success' => false,
             'message' => "Alta incorrecta!",
             'data' => $validator->errors(),
           ];
           // Retornem l'array convertit a JSON i el codi d'error 404 de
           //  HTTTP
           return response()->json($response, 404);     
        }

                
        $Clients = Client::create($input);

        // Responem a la crida amb un tot ok!
        $response = [
           'success' => true,
           'data'    => $Clients,
           'message' => "Alta correcta",

        ];

        return response()->json($response, 200);

        try {

            $testdni = preg_match('/^[0-9]{8,8}[A-Z]$/g',$request->dni);
            $testtarja = preg_match('/^[0-9]{14,14}[A-Z]$/g',$request->tarja_sanitaria);
            $validator = Validator::make($input, [
                'nom' => 'required | min:3 | max:20' ,
           ]);
           if($validator->fails() || !$testdni){
               $response = [
                   'success' => true, 
                   'message' => "errors de validacio",
                   'data' => $validator->errors()->all(), 
               ];
         
               return response()->json($response, 404); 
           }            
           
           $Clients = new Client;
           $Clients->dni = $request->dni;
           $Clients->nom = $request->nom;
           $Clients->genere = $request->genere;
           $Clients->tarja_sanitaria = $request->tarja_sanitaria;
           $Clients->save();
           $response = [
               'success' => true, 
               'message' => "Informacion Trabajador recuperada",
               'data' => $Clients, 
           ];
           return response()->json($response, 200);  
   
       } catch (\Throwable $th) {
           $response = [
               'success' => false, 
               'message' => "Error al crear el cliente",
               'data' => $th, 
           ];
           return response()->json($response, 404);  
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Clients = Client::find($id);

        // No s'ha trobat el client 
        if($Clients==null) {
            $response = [
              'success' => false,
              'message' => "Client no trobat",    
            ];
            return response()->json($response, 404); 

        }
        else { // El producte s'ha trobat

            $response = [
              'success' => true,
              'data'    => $Clients,
              'message' => "Client recuperat",
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //     //
    //     $testDni =  preg_match('/^[0-9]{8,8}[A-Za-z]$/g',$request->dni);
    //     $testtarja = preg_match('/^[0-9]{14,14}[A-Z]$/g',$request->tarja_sanitaria);
    //     $validator = Validator::make($input, [
    //          'nom' => 'required | min:3 | max:20' ,
    //     ]);
    //     if($validator->fails() || !$testDni){
    //         $response = [
    //             'success' => true, 
    //             'message' => "errors de validacio",
    //             'data' => $validator->errors()->all(), 
    //         ];
      
    //         return response()->json($response, 404); 
    //     }
    //     try {
    //         //code...

    //     $Clients = Client::findOrFail($id);
    //     $Clients->dni = $request->dni;
    //     $Clients->nom = $request->nom;
    //     $Clients->genere = $request->genere;
    //     $Clients->tarja_sanitaria = $request->tarja_sanitaria;
    //     $Clients->save();
        
    //     $response = [
    //         'success' => true, 
    //         'message' => "Informacion Client actualizada con exito",
    //         'data' => $Clients, 
    //     ];
  
    //     return response()->json($response, 200); 
    // } catch (\Throwable $th) {
    //     $response = [
    //         'success' => false, 
    //         'message' => "Error al actualizar el cliente",
    //         'data' => $th, 
    //     ];
    //     return response()->json($response, 404);  
    // }

    $Clients = Client::find($id);
    if($Clients==null) {
        $response = [
            'success' => false,
            'message' => "Client no trobat",
            'data' => [],
        ];        
        return response()->json($response,404);
    }   
    $Clients->dni = $request->dni;
    $Clients->nom = $request->nom;
    $Clients->genere = $request->genere;  
    $Clients->tarja_sanitaria = $request->tarja_sanitaria;

    $Clients->save();
    $response = [
        'success' => true,
        'message' => "Client trobat",
        'data' => $Clients,
    ];
    return response()->json($response,200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
                // Eliminem el client segons el codi que ens passin

        // El busquem a la BD
        $Clients = Client::find($id);

        // Si no trobem el client responem amb informació
        // sobre l'error
        if($Clients==null) {
            $Clients = [
            'success' => false,
            'message' => "Client no trobat",            
            ];
            return response()->json($response, 404); 

        }
        else { // El client l'hem trobat

            // posar dins try-catch en cas de haver-hi relacions clau forana!!
            $Clients->delete();

            $response = [
            'success' => true,
            'data'    => $Clients,
            'message' => "Client esborrat",
            ];

            return response()->json($response, 200);
        }
    }
}
