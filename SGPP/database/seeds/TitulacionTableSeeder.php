<?php

use Illuminate\Database\Seeder;
use App\Titulacion;
use App\Institucion;
use App\User;
use App\Role;

class TitulacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('nombre', 'Administrador')->first();
        $role_profInst = Role::where('nombre', 'Tutor Institucional')->first();
        $role_tutorAcad = Role::where('nombre', 'Tutor Académico')->first();
        $role_director= Role::where('nombre', 'Director de Grado')->first();
        $role_alumno= Role::where('nombre', 'Alumno')->first();

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

        $institucion = new Institucion();
        $institucion->denominacion = "Avanade";
        $institucion->telefono = "555 555 555";
        $institucion->direccion = "Avenida avenue";
        $institucion->titulacion()->associate($titulacion_inf);
        $institucion->save();

        $usuario_profInst = new User();
        $usuario_profInst->name = "Pol";
        $usuario_profInst->apellido1 = "Araujo";
        $usuario_profInst->apellido2 = "Vera";
        $usuario_profInst->docIdentificacion = "08553630";
        $usuario_profInst->email = "upmu48ajj@gmail.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->institucion()->associate($institucion);
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_profInst);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Isabel";
        $usuario_profInst->apellido1 = "Alcaraz";
        $usuario_profInst->apellido2 = "Moyano";
        $usuario_profInst->docIdentificacion = "36963754";
        $usuario_profInst->email = "wqyrtaypy9@writeme.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->institucion()->associate($institucion);
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_profInst);

        $institucion = new Institucion();
        $institucion->denominacion = "Microsoft";
        $institucion->telefono = "555 555 555";
        $institucion->direccion = "";
        $institucion->titulacion()->associate($titulacion_inf);
        $institucion->save();

        $institucion = new Institucion();
        $institucion->denominacion = "Real Madrid";
        $institucion->telefono = "555 555 555";
        $institucion->direccion = "";
        $institucion->titulacion()->associate($titulacion_cafyd);
        $institucion->save();

        $usuario_profInst = new User();
        $usuario_profInst->name = "Alfonso";
        $usuario_profInst->apellido1 = "De la Fuente";
        $usuario_profInst->apellido2 = "García";
        $usuario_profInst->docIdentificacion = "09783935";
        $usuario_profInst->email = "617m6ghq0@lycos.at";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->institucion()->associate($institucion);
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_profInst);

        $institucion = new Institucion();
        $institucion->denominacion = "CEIPSO Príncipes de Asturias";
        $institucion->telefono = "555 555 555";
        $institucion->direccion = "";
        $institucion->titulacion()->associate($titulacion_infantil);
        $institucion->save();

        $institucion = new Institucion();
        $institucion->denominacion = "Escolapios";
        $institucion->telefono = "555 555 555";
        $institucion->direccion = "";
        $institucion->titulacion()->associate($titulacion_prim);
        $institucion->save();

        $institucion = new Institucion();
        $institucion->denominacion = "Clínica Moncloa";
        $institucion->telefono = "555 555 555";
        $institucion->direccion = "";
        $institucion->titulacion()->associate($titulacion_far);
        $institucion->save();

        $usuario_profInst = new User();
        $usuario_profInst->name = "Maria Carmen";
        $usuario_profInst->apellido1 = "Lopez";
        $usuario_profInst->apellido2 = "Paiagua";
        $usuario_profInst->docIdentificacion = "41741802";
        $usuario_profInst->email = "xxbyfqdq@witty.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->institucion()->associate($institucion);
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_profInst);
    }
}
