<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'id',
        'dni',
        'nom',
        'genere',
        'tarja_sanitaria'
    ];
    protected $table = 'clients';
}
