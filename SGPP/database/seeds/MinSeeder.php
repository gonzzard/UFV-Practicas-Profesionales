<?php

use Illuminate\Database\Seeder;
use App\Estadoasignacion;
use App\Cursoacad;
use App\Titulacion;
use App\Institucion;
use App\Role;
use App\User;

class MinSeeder extends Seeder
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

        $role_admin = Role::where('nombre', 'Administrador')->first();

        $usuario_admin = new User();
        $usuario_admin->name = "Administrador";
        $usuario_admin->docIdentificacion = "54023837";
        $usuario_admin->email = "admin@f.es";
        $usuario_admin->password = bcrypt('1234asdF!');
        $usuario_admin->save();
        $usuario_admin->roles()->attach($role_admin);

        $estadoAsig = new Estadoasignacion();
        $estadoAsig->denominacion = "EN PROCESO";
        $estadoAsig->save();

        $estadoAsig = new Estadoasignacion();
        $estadoAsig->denominacion = "TERMINADA";
        $estadoAsig->save();

        $estadoAsig = new Estadoasignacion();
        $estadoAsig->denominacion = "CAMBIO DE PRACTICAS";
        $estadoAsig->save();

	$titulacion_inf = new Titulacion();
        $titulacion_inf->denominacion = 'Grado en Ingeniería Informática';
        $titulacion_inf->mencion = false;
        $titulacion_inf->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Título propio de Experto en Robótica';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_inf);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Título propio de Experto en Desarrollo de Videojuegos';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_inf);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Título propio en Experto en Ciberseguridad y Hacking Ético';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_inf);
        $titulacion->save();

        $titulacion_far = new Titulacion();
        $titulacion_far->denominacion = 'Grado en Farmacia';
        $titulacion_far->mencion = false;
        $titulacion_far->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Título propio de Experto en Innovación Farmacéutica';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_far);
        $titulacion->save();

        $titulacion_prim = new Titulacion();
        $titulacion_prim->denominacion = 'Grado en Educación Primaria';
        $titulacion_prim->mencion = false;
        $titulacion_prim->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Lengua Extranjera';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_prim);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Educación Musical';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_prim);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Educación Física';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_prim);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Atención a los Alumnos con Necesidades Específicas de Apoyo Educativo (Pedagogía Terapéutica)';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_prim);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Religión y Moral Católica y su Pedagogía';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_prim);
        $titulacion->save();

        $titulacion_infantil = new Titulacion();
        $titulacion_infantil->denominacion = 'Grado en Educación Infantil';
        $titulacion_infantil->mencion = false;
        $titulacion_infantil->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Atención a los Alumnos con Necesidades Específicas de Apoyo Educativo (Pedagogía Terapéutica)';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_infantil);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Estimulación Temprana';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_infantil);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Lengua Extranjera';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_infantil);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Religión y Moral Católica y su Pedagogía';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_infantil);
        $titulacion->save();

        $titulacion_cafyd= new Titulacion();
        $titulacion_cafyd->denominacion = 'Grado en Ciencias de la Actividad Física y del Deporte';
        $titulacion_cafyd->mencion = false;
        $titulacion_cafyd->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Enseñanza de la Actividad Física y del Deporte';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_cafyd);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Actividad Física y Salud';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_cafyd);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Preparación Física y rendimiento';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_cafyd);
        $titulacion->save();

        $titulacion = new Titulacion();
        $titulacion->denominacion = 'Dirección Deportiva';
        $titulacion->mencion = true;
        $titulacion->titulacionPrincipal()->associate($titulacion_cafyd);
        $titulacion->save();
    }
}
