<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Turnos extends Model
{
    use HasFactory;


    protected $table = 'turnos';
    protected $dates = ['fechahora'];

    protected $fillable = [
        'idCliente',
        'idUser',
        'fechahora',
        'finalizacion',
        'hora',
        'status',
        'active'
    ];
}
