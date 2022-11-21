<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    // //
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Clients = Clients::all();
         $Clients= Clients::Paginate(10);
        return view('Clients.index',compact('Clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('Clients.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [ 'dni' => 'required | min:3 | max:20',
            'name' => 'required | min:3 | max:20' ,
            'targeta_sanitaria' => 'required | min:3 | max:28']
        );
        
        echo $request->name;
        $Clients = new Clients;
        $Clients->dni = $request->dni;
        $Clients->name = $request->name;
        $Clients->gender = $request->gender;
        $Clients->targeta_sanitaria = $request->targeta_sanitaria;
        $Clients->save();
        return redirect('/clients');
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
        $clients = Clients::findOrFail($id);
        return view("Clients.update",compact('Clients'));
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
        $request->validate(
            [ 'name' => 'required | min:3 | max:20' ]
        );
        
        $clients = Clients::findOrFail($id);
        $clients->name = $request->name;
        $clients->save();
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Clients::findOrFail($id);
        $clients->delete();
        return redirect('/clients');
    }
}
