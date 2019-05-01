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
        date_default_timezone_set('Europe/Madrid');
        // Unix
        setlocale(LC_TIME, 'es_ES.UTF-8');
        // En windows
        setlocale(LC_TIME, 'spanish');

        return Excel::download(new AsignacionExport, 'Avance_Practicas_'. strftime("%A, %d de %B del %Y") . '.xlsx');
        
    }

    public function reporteAvance()
    {
    }
}
