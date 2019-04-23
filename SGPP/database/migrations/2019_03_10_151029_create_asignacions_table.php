<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacions', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('horasRealizadas');
            $table->decimal('notaFinal');
            $table->decimal('notaTutorInst')->default(-1);
            $table->integer('alumno_id')->unsigned();
            $table->foreign('alumno_id')->references('id')->on('users');
            $table->integer('tutorAcad_id')->unsigned();
            $table->foreign('tutorAcad_id')->references('id')->on('users');
            $table->integer('tutorInst_id')->unsigned();
            $table->foreign('tutorInst_id')->references('id')->on('users');
            $table->integer('practica_id')->unsigned();
            $table->foreign('practica_id')->references('id')->on('practicas');
            $table->integer('asignacion_anterior_id')->nullable()->unsigned();
            $table->foreign('asignacion_anterior_id')->references('id')->on('asignacions');
            $table->string('observacion');
            $table->text('observacionTutInst');
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
        Schema::dropIfExists('asignacions');
    }
}
