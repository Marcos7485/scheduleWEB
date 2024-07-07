<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalHash extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'globalHash';

    protected $fillable = [
        'idUser',
        'hash',
        'lapso',
        'active'
    ];
}
