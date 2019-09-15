<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER Ingreso_Producto AFTER INSERT ON `producto` FOR EACH ROW
            BEGIN
                INSERT INTO inventario (`producto_id`, `stock`, `created_at`, `updated_at`) 
                VALUES (NEW.id, 0, now(), null);
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
        DB::unprepared('DROP TRIGGER IF EXISTS `Ingreso_Producto`');
    }
}
