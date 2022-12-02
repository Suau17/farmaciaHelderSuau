<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod_Prov extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'proveidor_id',
        'producte_id'
    ];
}
