<?php

use Illuminate\Database\Seeder;
use App\Titulacion;
use App\User;

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

        $director = User::where('id', 2)->first();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Título propio en Robótica';
        $titulacion->mencion = true;
        $titulacion->director()->associate($director)->save();
        $titulacion->save();
    }
}
