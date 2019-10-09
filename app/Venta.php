<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';

    protected $fillable = [
        'id','cliente_id','monto','no_factura','factura_emitida_id'
    ];

    public function detalle_venta()
    {
    	return $this->hasMany('App\DetalleVenta');
    }

    public function cliente()
    {
    	return $this->belongsTo('App\Cliente');
    }
}
