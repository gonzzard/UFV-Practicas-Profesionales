<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionPracticasCursoacad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('practicas', function (Blueprint $table) {
            $table->integer('cursoacad_id')->unsigned();
            $table->foreign('cursoacad_id')->references('id')->on('cursoacads');
            $table->integer('titulacion_id')->unsigned();
            $table->foreign('titulacion_id')->references('id')->on('titulacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practicas', function (Blueprint $table) {
            //
        });
    }
}
