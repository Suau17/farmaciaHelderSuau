<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producte;
use App\Http\Resources\ProducteResource as ProducteResource;
use Validator;
use Laravel\Sanctum\HasApiTokens;
class ProducteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Productes= Producte::all();
         $Productes= Producte::Paginate(10);
        // return viebw('Producte.index',compact('Productes'));
        $response = [
            'success' => true,  // Per indicar que Tot ha anat bé
          'message' => "Llista productes recuperada", // missatge
          'data' => $Productes,
        ];
        return response()->json($response, 200);
    }
    public function list()
    {
        //
        $Productes= Producte::all();
        // return viebw('Producte.index',compact('Productes'));
        $response = [
            'success' => true,  // Per indicar que Tot ha anat bé
          'message' => "Llista de tots els productes per a datalist", // missatge
          'data' => $Productes,
        ];
        return response()->json($response, 200);
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
        $input = $request->all();

        // Creem un validador de les dades enviades, i li passem les regles
        // que volem comprovar
        $validator = Validator::make($input, [
         
          'nom' => 'required|min:3',
          'tipus' => 'required|max:256',
          'preu' => 'required',
          'stock' => 'required'
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

                
        $Productes = Producte::create($input);

        // Responem a la crida amb un tot ok!
        $response = [
           'success' => true,
           'data'    => $Productes,
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
           // Busquem un producte en concret segons els seu id
           $Productes = Producte::find($id);

           // No s'ha trobat el producte 
           if($Productes==null) {
               $response = [
                 'success' => false,
                 'message' => "Producte no trobat",            
               ];
               return response()->json($response, 404); 
   
           }
           else { // El producte s'ha trobat
   
               $response = [
                 'success' => true,
                 'data'    => $Productes,
                 'message' => "Producte recuperat",
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
        $Productes = Producte::find($id);
        if($Productes==null) {
            $response = [
                'success' => false,
                'message' => "Producte no trobat",
                'data' => [],
            ];        
            return response()->json($response,404);
        }   
        $Productes->nom = $request->nom;
        $Productes->tipus = $request->tipus; 
        $Productes->preu = $request->preu;
        $Productes->stock = $request->stock; 

        $Productes->save();
        $response = [
            'success' => true,
            'message' => "Proveidors trobat",
            'data' => $Productes,
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
        // Eliminem el producte segons el codi que ens passin

        // El busquem a la BD
        $Productes = Producte::find($id);

        // Si no trobem el producte responem amb informació
        // sobre l'error
        if($Productes==null) {
            $response = [
            'success' => false,
            'message' => "Producte no trobat",            
            ];
            return response()->json($response, 404); 

        }
        else { // El producte l'hem trobat

            // posar dins try-catch en cas de haver-hi relacions clau forana!!
            $Productes->delete();

            $response = [
            'success' => true,
            'data'    => $Productes,
            'message' => "Producte esborrat",
            ];

            return response()->json($response, 200);
        }
    }
}
