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
        'prod_ID'
    ];
    public function Proveidor(){
        return $this->belongsTo(Proveidor::class);
                                    //get id de producte.
    }

    public function Producte(){
        return $this->belongsToMany(Producte::class,'prod_ID');
                                    //get id de producte.
    }

}
