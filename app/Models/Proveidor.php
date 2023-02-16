<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveidor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nomE',
        'pais',
    ];
    // public function Proveidor(){
    //     return $this->belongsTo(Proveidor::class);
    //                                 //get id de producte.
    // }

    public function productes(){
        return $this->belongsToMany(Producte::class,'prod_prov');
                                    //get id de producte.
    }

}
