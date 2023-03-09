<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveidor;
use App\Models\Producte;
use App\Models\Prod_Prov;

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
         //$Proveidors= Proveidor::all();
         // $Proveidors= Proveidor::paginate(10);
        return view('Proveidor.index');
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
        $Proveidors->nomE = $request->nomE;
        $Proveidors->pais = $request->pais;
        
        $Proveidors->save();
        return redirect('/Proveidor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('Proveidor.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Proveidor = Proveidor::findOrFail($id);
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
        
         $proveidor = Proveidor::findOrFail($id);
        $proveidor->nomE = $request->nomE;
        $proveidor->pais= $request->pais;
        
        
        $proveidor->save();
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
