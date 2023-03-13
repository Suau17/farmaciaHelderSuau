<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'preuTotal',
        'estado'
    ]; 

    public function productes()
    {
  	
	// La taula per seguir convencions Laravel s'hauria d'haver anomenat superhero_superpower!!! 
      
   	return $this->belongsToMany(
       		 Producte::class,
        	'producte_pedido');
       
     }

     
     public function client()
     {
         return $this->belongsTo(Client::class);
     }
}
