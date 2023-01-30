<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prod_Prov;
use App\Http\Resources\Prod_ProvResource as Prod_ProvResource;

class Prod_ProvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Prod_Provs = Prod_Prov::all();
         $Prod_Provs = Prod_Prov::Paginate(10);
        // return view('Producte.index',compact('Productes'));
        $response = [
            'success' => true,  // Per indicar que Tot ha anat bé
          'message' => "Llista productes recuperada", // missatge
          'data' => Prod_ProvResource::collection($Prod_Provs),
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
        $Prod_Provs = Prod_Prov::find($id);

        // No s'ha trobat el producte 
        if($Prod_Provs ==null) {
            $response = [
              'success' => false,
              'message' => "Producte no trobat",            
            ];
            return response()->json($response, 404); 

        }
        else { // El producte s'ha trobat

            $response = [
              'success' => true,
              'data'    => new Prod_ProvResource($Prod_Provs),
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
