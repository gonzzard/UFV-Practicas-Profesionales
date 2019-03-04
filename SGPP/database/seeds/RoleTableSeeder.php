<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_administrador = new Role();
        $rol_administrador->nombre = "Administrador";
        $rol_administrador->descripcion = "Administrador del sistema.";

        $rol_administrador->save();

        $rol_alumno = new Role();
        $rol_alumno->nombre = "Alumno";
        $rol_alumno->descripcion = "Alumno del sistema.";

        $rol_alumno->save();

        $rol_Tutor_Inst = new Role();
        $rol_Tutor_Inst->nombre = "Tutor Institucional";
        $rol_Tutor_Inst->descripcion = "Tutor Institucional del sistema.";

        $rol_Tutor_Inst->save();

        $rol_Tutor_Acad = new Role();
        $rol_Tutor_Acad->nombre = "Tutor Académico";
        $rol_Tutor_Acad->descripcion = "Tutor Académico del sistema.";

        $rol_Tutor_Acad->save();

        $rol_Director = new Role();
        $rol_Director->nombre = "Director de Grado";
        $rol_Director->descripcion = "Director de Grado del sistema.";

        $rol_Director->save();
    }
}
