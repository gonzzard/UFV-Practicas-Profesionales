<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsignacionExport;

use Illuminate\Http\Request;
use App\Asignacion;

class ReportesController extends Controller
{
    public function reporteAsignaciones()
    {
        return Excel::download(new AsignacionExport, 'users.xlsx');
        
    }

    public function reporteAvance()
    {
    }
}
