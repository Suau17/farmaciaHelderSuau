<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Prod_Prov extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'prod_prov';

    protected $fillable = [
        'id',
        'producte_id',
        'proveidor_id'
    ];
}
