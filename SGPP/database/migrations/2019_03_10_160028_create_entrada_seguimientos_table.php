<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradaSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_seguimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('actividad');
            $table->string('observacion');
            $table->string('urlEvidencias');
            $table->integer('horasRealizadas');
            $table->boolean('validado');
            $table->boolean('comprobado');
            $table->integer('asignacion_id')->unsigned();
            $table->foreign('asignacion_id')->references('id')->on('asignacions');
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
        Schema::dropIfExists('entrada_seguimientos');
    }
}
