<?php

use Illuminate\Database\Seeder;
use App\Institucion;

class InstitucionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institucion = new Institucion();
        $institucion->denominacion = "Avanade";
        $institucion->telefono = "666555444";
        $institucion->direccion = "Avenida avenue";
        $institucion->save();

        $institucion = new Institucion();
        $institucion->denominacion = "Microsoft";
        $institucion->telefono = "698557443";
        $institucion->direccion = "Calle Mayor";
        $institucion->save();
    }
}
