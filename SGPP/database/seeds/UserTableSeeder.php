<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
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

        $usuario_admin = new User();
        $usuario_admin->name = "Administrador";
        $usuario_admin->docIdentificacion = "54023837";
        $usuario_admin->email = "admin@f.es";
        $usuario_admin->password = bcrypt('1234asdf');
        $usuario_admin->save();
        $usuario_admin->roles()->attach($role_admin);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Armando";
        $usuario_profInst->apellido1 = "Alcaide";
        $usuario_profInst->apellido2 = "Ferreiro";
        $usuario_profInst->docIdentificacion = "96289675";
        $usuario_profInst->email = "g27a08nit@aim.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_alumno);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Julio";
        $usuario_profInst->apellido1 = "Godoy";
        $usuario_profInst->apellido2 = "Reyes";
        $usuario_profInst->docIdentificacion = "68945572";
        $usuario_profInst->email = "ic9wzoclq@mail.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_alumno);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Nadia";
        $usuario_profInst->apellido1 = "Barroso";
        $usuario_profInst->apellido2 = "Jorge";
        $usuario_profInst->docIdentificacion = "72394672";
        $usuario_profInst->email = "4r0od904uy@yahoo.es";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_alumno);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Jesús";
        $usuario_profInst->apellido1 = "Noguera";
        $usuario_profInst->apellido2 = "Castro";
        $usuario_profInst->docIdentificacion = "96007842";
        $usuario_profInst->email = "9v80n7ms@lycos.at";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_director);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Eloy";
        $usuario_profInst->apellido1 = "Grande";
        $usuario_profInst->apellido2 = "Delgado";
        $usuario_profInst->docIdentificacion = "52526151";
        $usuario_profInst->email = "tsfiqpfsdn@usa.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_director);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Fidel";
        $usuario_profInst->apellido1 = "Herranz";
        $usuario_profInst->apellido2 = "Domenech";
        $usuario_profInst->docIdentificacion = "32512717";
        $usuario_profInst->email = "i4f4a7sy@usa.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_tutorAcad);

        $usuario_profInst = new User();
        $usuario_profInst->name = "Leyre";
        $usuario_profInst->apellido1 = "Rosado";
        $usuario_profInst->apellido2 = "Olivares";
        $usuario_profInst->docIdentificacion = "83758338";
        $usuario_profInst->email = "drah4yohz@witty.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_tutorAcad);

        $usuario_profInst = new User();
        $usuario_profInst->name = "José Ignacio";
        $usuario_profInst->apellido1 = "Rubio";
        $usuario_profInst->apellido2 = "Baena";
        $usuario_profInst->docIdentificacion = "76952963";
        $usuario_profInst->email = "ub656655m@mail.com";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();
        $usuario_profInst->roles()->attach($role_tutorAcad);


    }
}
