<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//haspiToken para los token de laravel
class Producte extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom',
        'tipus',
        
        
    ];
    // public function Producte(){
    //     return $this->belongsToMany(Producte::class);
                                    
    // }
    public function proveidors(){
        return $this->belongsToMany(Proveidor::class,'prod_prov');
                                    
    }
}
