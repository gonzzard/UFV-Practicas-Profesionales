<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaPracticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterio_encuesta_practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion');
            $table->integer('practica_id')->unsigned();
            $table->foreign('practica_id')->references('id')->on('practicas');
            $table->timestamps();
        });
        
        Schema::create('encuesta_practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota');
            $table->string('observacion');
            $table->integer('asignacion_id')->unsigned();
            $table->foreign('asignacion_id')->references('id')->on('asignacions');
            $table->integer('criterio_encuesta_practicas_id')->unsigned();
            $table->foreign('criterio_encuesta_practicas_id')->references('id')->on('criterio_encuesta_practicas');
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
        Schema::dropIfExists('encuesta_practicas');
        Schema::dropIfExists('criterio_encuesta_practicas');
    }
}
