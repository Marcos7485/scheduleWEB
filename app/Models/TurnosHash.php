<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnosHash extends Model
{
    use HasFactory;

    
    protected $table = 'turnos_hash';

    protected $fillable = [
        'idTurno',
        'idUser',
        'hash',
        'lapso',
        'active'
    ];
}
