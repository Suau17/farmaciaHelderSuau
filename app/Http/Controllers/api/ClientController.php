<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Mostrar els clients emmagatzemats a la base de dades amb un màxim de 10 per pàgina
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
 
     //Crear nous clients
     public function create(){
         return view('Client.new');
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
 
     //Emmagatzemar els clients creats
     public function store(Request $request)
     {
         $request->validate(
              [ 'dni' => 'required | min:9 | max:9',
              'nom' => 'required | min:3 | max:20' ,
              'tarja_sanitaria' => 'required | min:14 | max:14']
          );
         
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
 
     //Editar els clients de la base de dades
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
 
     //Actualitzar informació dels clients de la base de dades
     public function update(Request $request, $id)
     {
         $request->validate(
             [ 'dni' => 'required | min:9 | max:9',
             'nom' => 'required | min:3 | max:20' ,
             'tarja_sanitaria' => 'required | min:14 | max:14']
         );
         
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
 
     //Eliminar clients de la base de dades
     public function destroy($id)
     {
         $Clients = Client::findOrFail($id);
         $Clients->delete();
         return redirect('/Client');
     }

}
