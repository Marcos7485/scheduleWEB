<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalHash extends Model
{
    use HasFactory;

    protected $table = 'globalHash';

    protected $fillable = [
        'idUser',
        'hash',
        'lapso',
        'active'
    ];
}
