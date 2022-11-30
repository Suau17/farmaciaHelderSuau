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
        'pais'
    ];
    public function Producte(){
        return $this->belongsToMany('App\Producte');
    }
}
