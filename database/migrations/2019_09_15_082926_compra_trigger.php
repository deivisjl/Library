<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompraTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('
            CREATE TRIGGER Compra_Producto AFTER INSERT ON `detalle_compra` FOR EACH ROW
                BEGIN
                    
                    UPDATE inventario set stock = (stock + NEW.cantidad) where producto_id = NEW.producto_id;

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
        DB::unprepared('DROP TRIGGER IF EXISTS `Compra_Producto`');
    }
}
