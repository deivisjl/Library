<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';

    protected $fillable = [
        'id','proveedor_id','factura_compra_no','monto','anulada'
    ];
}
