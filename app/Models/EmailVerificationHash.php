<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationHash extends Model
{
    use HasFactory;

    protected $table = 'emailverificationhash';

    protected $fillable = [
        'idUser',
        'hash',
        'active',
    ];
}
