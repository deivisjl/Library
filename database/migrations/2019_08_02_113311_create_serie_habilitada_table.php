<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerieHabilitadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_habilitada', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('serie_id')->unsigned();
            $table->bigInteger('desde');
            $table->bigInteger('hasta');
            $table->integer('activo')->default(1);
            $table->foreign('serie_id')->references('id')->on('serie');
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
        Schema::dropIfExists('serie_habilitada');
    }
}
