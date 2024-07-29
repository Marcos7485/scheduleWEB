<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
    use HasFactory;
    protected $table = 'trabajadores';

    protected $fillable = [
        'idEmpresa',
        'image',
        'background',
        'nombre',
        'frase',
        'selected',
        'active'
    ];

}
