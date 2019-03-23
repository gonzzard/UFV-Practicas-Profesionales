<?php

use Illuminate\Database\Seeder;
use App\Cursoacad;

class CursoacadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cursoacad = new Cursoacad();
        $cursoacad->denominacion = "2020-21";
        $cursoacad->activo = false;
        $cursoacad->save();

        $cursoacad = new Cursoacad();
        $cursoacad->denominacion = "2019-20";
        $cursoacad->activo = false;
        $cursoacad->save();

        $cursoacad = new Cursoacad();
        $cursoacad->denominacion = "2018-19";
        $cursoacad->activo = true;
        $cursoacad->save();

        $cursoacad = new Cursoacad();
        $cursoacad->denominacion = "2017-18";
        $cursoacad->activo = false;
        $cursoacad->save();

        $cursoacad = new Cursoacad();
        $cursoacad->denominacion = "2016-17";
        $cursoacad->activo = false;
        $cursoacad->save();
    }
}
