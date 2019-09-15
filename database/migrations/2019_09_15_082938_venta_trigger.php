<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VentaTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER Venta_Producto AFTER INSERT ON `detalle_venta` FOR EACH ROW
                BEGIN
                    
                    UPDATE inventario set stock = (stock - NEW.cantidad) where producto_id = NEW.producto_id;

                END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `Venta_Producto`');
    }
}
