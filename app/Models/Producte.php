<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//haspiToken para los token de laravel
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Producte extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'id',
        'nom',
        'tipus',
        'preu',
        'stock'
        
        
    ];
    // public function Producte(){
    //     return $this->belongsToMany(Producte::class);
                                    
    // }
    public function proveidors(){
        return $this->belongsToMany(Proveidor::class,'prod_prov');
                                    
    }
}
