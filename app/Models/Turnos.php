<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Turnos extends Model
{
    use HasFactory;


    protected $table = 'turnos';
    protected $dates = ['fecha'];

    protected $fillable = [
        'idCliente',
        'idUser',
        'fecha',
        'hora',
        'status',
        'active'
    ];
}
