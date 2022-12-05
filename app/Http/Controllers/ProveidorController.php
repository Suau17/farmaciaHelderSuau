<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveidor;
use App\Models\Producte;

class ProveidorController extends Controller
{
    //// //
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Mostrar fins a un màxim de 10 per pàgina els proveïdors emmagatzemats a la base de dades
    public function index()
    {
        $Proveidors= Proveidor::all();
         $Proveidors= Proveidor::Paginate(10);
        return view('Proveidor.index',compact('Proveidors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Afegir proveidors
    public function create(){
        return view('Proveidor.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Emmagatzemar-los a la base de dades
    public function store(Request $request)
    {
        // $request->validate(
        //     [ 'dni' => 'required | min:3 | max:20',
        //     'nom' => 'required | min:3 | max:20' ,
        //     'tarja_sanitaria' => 'required | min:3 | max:28']
        // );
        
        echo $request->name;
        $Proveidors = new Proveidor;
        $Proveidors->nom = $request->nom;
        $Proveidors->pais = $request->pais;
        $Proveidors->prod_ID = $request->prod_ID;
        $Proveidors->save();
        return redirect('/Proveidor');
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
        $Proveidors = Proveidor::findOrFail($id);
        return view("Proveidor.update",compact('Proveidor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Actualitzar proveidors de la base de dades
    public function update(Request $request, $id)
    {
        // $request->validate(
        //     [ 'name' => 'required | min:3 | max:20' ]
        // );
        
        $Proveidors = Producte::findOrFail($id);
        $Proveidors->nom = $request->nom;
        $Proveidors->pais= $request->pais;
        $Proveidors->prod_ID= $request->prod_ID;
        $Proveidors->save();
        return redirect('/Proveidor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Eliminar proveidors de la base de dades
    public function destroy($id)
    {
        $Proveidors= Proveidor::findOrFail($id);
        $Proveidors->delete();
        return redirect('/Proveidor');
    }
}
