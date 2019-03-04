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
    }
}
