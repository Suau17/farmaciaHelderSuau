<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveidor;
use App\Http\Resources\ProveidorResource as ProveidorResource;

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
        // return view('Producte.index',compact('Productes'));
        $response = [
            'success' => true,  // Per indicar que Tot ha anat bé
          'message' => "Llista productes recuperada", // missatge
          'data' => ProveidorResource::collection($Proveidors),
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
               'data'    => new ProveidorResource($Proveidors),
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
