<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesos extends Model
{
    use HasFactory;
    protected $table = 'accesos';

    protected $fillable = [
        'idEmpresa',
        'idTrabajador',
        'hash',
        'password',
        'active'
    ];

}
