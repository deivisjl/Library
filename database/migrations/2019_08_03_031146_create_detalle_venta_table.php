<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('venta_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->decimal('precio_unitario',7,2);
            $table->decimal('subtotal');
            $table->foreign('venta_id')->references('id')->on('venta');
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_venta');
    }
}
