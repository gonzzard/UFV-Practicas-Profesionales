<?php

namespace App\Imports;
 
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
 
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try
        {
            

            if($row[0] == "" || $row[0] == null
                || $row[1] == "" || $row[1] == null
                || $row[3] == "" || $row[3] == null
                || $row[4] == "" || $row[4] == null
                || !filter_var($row[3], FILTER_VALIDATE_EMAIL)
                || !preg_match('/^[0-9]{8}$/', $row[4]))
            {
                return null;
            }

            $user = User::create([
                'name' => $row[0],
                'apellido1' => $row[1],
                'apellido2' => $row[2],
                'email' => $row[3],
                'docIdentificacion' => $row[4],
                'password' => Hash::make($row[4]),
            ]);

            $user->roles()->attach(Role::where('id',$row[5])->first());

            $user->activo = 1;

            $user->save();

            return $user;

        } catch(\Exception $e)
        {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            return null;
        }
    }
}