<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

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
        $Clients= Client::all();
         $Clients= Client::Paginate(10);
        return view('Client.index',compact('Clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('Client.new');
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
        $Clients = new Client;
        $Clients->dni = $request->dni;
        $Clients->nom = $request->nom;
        $Clients->genere = $request->genere;
        $Clients->tarja_sanitaria = $request->tarja_sanitaria;
        $Clients->save();
        return redirect('/Client');
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
        $Clients = Client::findOrFail($id);
        return view("Client.update",compact('Clients'));
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
        
        $Clients = Client::findOrFail($id);
        $Clients->dni = $request->dni;
        $Clients->nom = $request->nom;
        $Clients->genere = $request->genere;
        $Clients->tarja_sanitaria = $request->tarja_sanitaria;
        $Clients->save();
        return redirect('/Client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Clients = Client::findOrFail($id);
        $Clients->delete();
        return redirect('/Client');
    }
}
