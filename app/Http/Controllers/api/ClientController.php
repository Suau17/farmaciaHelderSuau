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
        return view('client/index');

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
          'id' => 'required|max:25',
          'dni' => 'required|numeric|min:0',
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

        // No s'ha trobat el producte 
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
        //
        
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
    }
}
