<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producte;
use App\Models\Proveidor;

class ProducteController extends Controller
{
    // //
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Mostrar els productes emmagatzemats a la base de dades amb un máxim de 10 per pàgina
    public function index()
    {
        $Productes= Producte::all();
         $Productes= Producte::Paginate(10);
        return view('Producte.index',compact('Productes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Crear productes per afegir-los a la base de dades
    public function create(){
        return view('Producte.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Emmagatzemar els productes a la base de dades
    public function store(Request $request)
    {
        
        echo $request->name;
        $Productes = new Producte;
        $Productes->nom = $request->nom;
        $Productes->tipus = $request->tipus;
        $Productes->save();
        return redirect('/Producte');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $Productes = Producte::findOrFail($id);
        return view("Producte.update",compact('Producte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Actualitzar els productes existents a la base de dades
    public function update(Request $request, $id)
    {
        // $request->validate(
        //     [ 'name' => 'required | min:3 | max:20' ]
        // );
        
        $Productes = Producte::findOrFail($id);
        $Productes->nom = $request->nom;
        $Productes->tipus= $request->tipus;
        $Productes->save();
        return redirect('/Producte');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Eliminar els productes de la base de dades
    public function destroy($id)
    {
        $Productes = Producte::findOrFail($id);
        $Productes->delete();
        return redirect('/Producte');
    }
}
