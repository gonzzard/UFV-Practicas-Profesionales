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

        $usuario_admin = new User();
        $usuario_admin->name = "Administrador";
        $usuario_admin->docIdentificacion = "54023837B";
        $usuario_admin->email = "gonzalo_2805@hotmail.es";
        $usuario_admin->password = bcrypt('1234asdF!');
        $usuario_admin->save();

        $usuario_admin->roles()->attach($role_admin);

        $role_profInst = Role::where('nombre', 'Tutor Institucional')->first();

        $usuario_profInst = new User();
        $usuario_profInst->name = "Gonzalo";
        $usuario_profInst->apellido1 = "de las Heras";
        $usuario_profInst->apellido2 = "de Matías";
        $usuario_profInst->docIdentificacion = "00000001R";
        $usuario_profInst->email = "test@ufv.es";
        $usuario_profInst->password = bcrypt('1234asdf');
        $usuario_profInst->save();

        $usuario_profInst->roles()->attach($role_profInst);
    }
}
