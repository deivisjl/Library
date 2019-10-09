<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaEmitida extends Model
{
    protected $table = 'factura_emitida';

    protected $fillable = [
        'id','serie_habilitada_id','no_factura'
    ];
}
