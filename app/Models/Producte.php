<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom',
        'tipus',
        'prov_ID'
        
    ];
    public function Producte(){
        return $this->belongsToMany(Producte::class);
                                    
    }
    public function Proveidor(){
        return $this->belongsToMany(Proveidor::class,'prov_ID');
                                    
    }
}
