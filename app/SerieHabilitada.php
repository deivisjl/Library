<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SerieHabilitada extends Model
{
    protected $table = 'serie_habilitada';

    protected $fillable = [
       'id','serie_id','desde','hasta','activo',
    ];
}
