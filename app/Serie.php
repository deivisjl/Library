<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'serie';

    protected $fillable = [
        'id','nombre','descripcion'
    ];

}
