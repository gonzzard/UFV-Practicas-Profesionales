<?php

use Illuminate\Database\Seeder;
use App\Criterioevaluacion;

class CriterioevaluacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterio = new Criterioevaluacion();
        $criterio->denominacion = 'Criterio de evaluacion 1';
        $criterio->ponderacion = 20;
        $criterio->save();

        $criterio = new Criterioevaluacion();
        $criterio->denominacion= 'Criterio de evaluacion 2';
        $criterio->ponderacion = 45;
        $criterio->save();

        $criterio = new Criterioevaluacion();
        $criterio->denominacion ='Criterio de evaluacion 3';
        $criterio->ponderacion = 35;
        $criterio->save();
    }
}
