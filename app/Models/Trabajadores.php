<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajadores extends Model
{
    use HasFactory;
    use SoftDeletes;
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
