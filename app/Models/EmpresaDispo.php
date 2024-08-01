<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaDispo extends Model
{
    use HasFactory;

    protected $table = 'empresadispo';

    protected $fillable = [
        'idEmpresa',
        'idTrabajador',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'lapsos',
        'active',
    ];

}
