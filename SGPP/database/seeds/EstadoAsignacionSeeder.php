<?php

use Illuminate\Database\Seeder;
use App\Estadoasignacion;

class EstadoAsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadoAsig = new Estadoasignacion();
        $estadoAsig->denominacion = "EN PROCESO";
        $estadoAsig->save();

        $estadoAsig = new Estadoasignacion();
        $estadoAsig->denominacion = "TERMINADA";
        $estadoAsig->save();

        $estadoAsig = new Estadoasignacion();
        $estadoAsig->denominacion = "CAMBIO DE PRACTICAS";
        $estadoAsig->save();
    }
}
