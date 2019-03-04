<?php

use Illuminate\Database\Seeder;
use App\Titulacion;

class TitulacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Ingeniería Informática';
        $titulacion->mencion = false;
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Título propio en Robótica';
        $titulacion->mencion = true;
        $titulacion->save();
    }
}
