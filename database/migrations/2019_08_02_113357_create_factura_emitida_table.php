<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaEmitidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_emitida', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('serie_habilitada_id')->unsigned();
            $table->bigInteger('no_factura');
            $table->foreign('serie_habilitada_id')->references('id')->on('serie_habilitada');
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
        Schema::dropIfExists('factura_emitida');
    }
}
