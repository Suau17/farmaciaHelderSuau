<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveidor;
use App\Http\Resources\ProveidorResource as ProveidorResource;
use App\Models\Producte;
use Validator;
use Laravel\Sanctum\HasApiTokens;

class ProveidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Proveidors= Proveidor::all();
        $Proveidors= Proveidor::Paginate(10);

        $Proveidors= Proveidor::Paginate(10);


        $response = [
            'success' => true,
            'message' => "Llistat planetes recuperat",
            'data' => $Proveidors,
        ];

        //return $response;
        return response()->json($response,200);
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
        $validator = Validator::make($input,
            [ 
                'nomE'=>'required|min:3|max:20',
            ]
        );

        if($validator->fails()) {

            $response = [
                'success' => false,
                'message' => "Errors de validació",
                'data' => $validator->errors()->all(),
            ];
            return response()->json($response,400);
        }
      
        // [ "name"=>"planetaP", .......]

        $Proveidors= Proveidor::create($input);

        $response = [
                'success' => true,
                'message' => "Planeta creat correctament",
                'data' => $Proveidors,
        ];
        return response()->json($response,200);
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
         $Proveidors = Proveidor::find($id);

         // No s'ha trobat el producte 
         if($Proveidors==null) {
             $response = [
               'success' => false,
               'message' => "Producte no trobat",            
             ];
             return response()->json($response, 404); 
 
         }
         else { // El producte s'ha trobat
 
             $response = [
               'success' => true,
               'data'    => $Proveidors,
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
        $Proveidor = Proveidor::find($id);
        if($Proveidor==null) {

            $response = [
                'success' => false,
                'message' => "Proveidors no trobat",
                'data' => [],
            ];
        
            return response()->json($response,404);
        }
        $Proveidor->nomE = $request->nomE;
        $Proveidor->pais= $request->pais;
        
        
        $Proveidor->save();
        $response = [
                'success' => true,
                'message' => "Proveidors trobat",
                'data' => $Proveidor,
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
        $Proveidors = Proveidor::find($id);
        if($Proveidors==null) {

            $response = [
                'success' => false,
                'message' => "Proveidors no trobat",
                'data' => [],
            ];
        
            return response()->json($response,404);
        }

        try {
            $Proveidors->delete();

            $response = [
                    'success' => true,
                    'message' => "Proveidorsesborrat",
                    'data' => $Proveidors,
                ];
            
            return response()->json($response,200);
        }
        catch(\Exception $e) {
            $response = [
                    'success' => false,
                    'message' => "Error esborrant planeta",                    
                ];
            
            return response()->json($response,400);

        }
    }
    }

