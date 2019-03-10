<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadoasignacionsRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignacions', function (Blueprint $table) {
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estadoasignacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignacions', function (Blueprint $table) {
            //
        });
    }
}
