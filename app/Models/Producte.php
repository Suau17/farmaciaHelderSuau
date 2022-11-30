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
        
    ];
    public function Proveidor(){
        return $this->belongsToMany('App\Proveidor');
    }
}
