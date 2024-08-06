<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoveryHash extends Model
{
    use HasFactory;

    protected $table = 'recoveryhash';

    protected $fillable = [
        'idUser',
        'hash',
        'active'
    ];

}
