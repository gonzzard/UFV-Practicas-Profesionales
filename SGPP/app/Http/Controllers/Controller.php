<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Cursoacad;
use App\Titulacion;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function CursoAcadActual()
    {
        return Cursoacad::where('activo', true)->first();
    }

    protected function GetIdsTitulacionesDirector($idDirector)
    {
        return Titulacion::where('director_id', $idDirector)->select('id')->get()->toArray();
    }
}
