<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionInstitucionUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('institucion_id')->unsigned()->index()->nullable();
            $table->foreign('institucion_id')->references('id')->on('institucions');
        });

        Schema::table('titulacions', function (Blueprint $table) {
            $table->integer('director_id')->unsigned()->index()->nullable();
            $table->foreign('director_id')->references('id')->on('users');

            $table->integer('titulacion_principal_id')->unsigned()->index()->nullable();
            $table->foreign('titulacion_principal_id')->references('id')->on('titulacions');
        });

        Schema::table('institucions', function (Blueprint $table) {
            $table->integer('responsable_id')->unsigned()->index()->nullable();
            $table->foreign('responsable_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
