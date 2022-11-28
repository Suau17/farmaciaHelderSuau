<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treballador;

class TreballadorController extends Controller
{
    //
    // //
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Treballadors= Treballador::all();
         $Treballadors= Treballador::Paginate(10);
        return view('Treballador.index',compact('Treballadors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('Treballador.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(
        //     [ 'dni' => 'required | min:3 | max:20',
        //     'nom' => 'required | min:3 | max:20' ,
        //     'tarja_sanitaria' => 'required | min:3 | max:28']
        // );
        
        echo $request->name;
        $Treballadors = new Treballador;
        $Treballadors->dni = $request->dni;
        $Treballadors->nom = $request->nom;
        $Treballadors->genere = $request->genere;
        $Treballadors->save();
        return redirect('/Treballador');
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
        $Treballadors = Treballador::findOrFail($id);
        return view("Treballador.update",compact('Treballadors'));
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
        // $request->validate(
        //     [ 'name' => 'required | min:3 | max:20' ]
        // );
        
        $Treballadors = Treballador::findOrFail($id);
        $Treballadors->dni = $request->dni;
        $Treballadors->nom = $request->nom;
        $Treballadors->genere = $request->genere;
        $Treballadors->save();
        return redirect('/Treballador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Treballadors = Treballador::findOrFail($id);
        $Treballadors->delete();
        return redirect('/Treballador');
    }
}
