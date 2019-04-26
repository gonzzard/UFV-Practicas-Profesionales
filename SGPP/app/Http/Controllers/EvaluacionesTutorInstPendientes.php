<?php

namespace App\Http\Controllers;

use Auth;
use App\Practica;
use App\Asignacion;
use App\Titulacion;
use App\Institucion;
use App\EstadoAsignacion;
use App\User;
use App\EntradaSeguimiento;
use Illuminate\Http\Request;

class EvaluacionesTutorInstPendientes extends Controller
{
    public function index()
    {
        $curso = $this->CursoAcadActual();
        $usuarioActual = Auth::user();

        $asignaciones = Asignacion::with('practica', 'practica.titulacion', 'practica.cursoacad')
        ->whereHas('practica', function ($query) use ($curso) {
            $query->where('cursoacad_id', $curso->id);
        })
        ->with('alumno')
        ->with('tutorAcad')
        ->with('tutorInst', 'tutorInst.institucion')
        ->with('estado')
        ->where('tutorInst_id', $usuarioActual->id)
        ->whereHas('estado', function ($query) {
            $query->where('denominacion', 'TERMINADA');
        })
        ->where('notaFinal', -1)
        ->where('notaTutorInst', '<', 0)
        ->where('horasRealizadas', '>=', 'practica.horasTotales')
        ->paginate(8);

        return view('tutorInst.EvaluacionesPendientes.index')->with(['asignaciones' => $asignaciones]);
    }

    public function evaluacion($id)
    {
        $asignacion = Asignacion::where('id', $id)
        ->with('practica', 'practica.titulacion', 'alumno', 'tutorInst', 'tutorAcad', 
            'estado', 'practica.cursoacad', 'tutorAcad.institucion')
        ->first();

        if($asignacion->notaTutorInst > 0)
        {
            return redirect('index');
        }

        return view('tutorInst.EvaluacionesPendientes.evaluarPractica')->with(['asignacion' => $asignacion]);
    }
    
    public function evaluarPracticas($id, Request $request)
    {
        $asignacion = Asignacion::where('id', $id)
        ->with('practica', 'practica.titulacion', 'alumno', 'tutorInst', 'tutorAcad', 
            'estado', 'practica.cursoacad', 'tutorAcad.institucion')
        ->first();

        $asignacion->observacionTutInst = $request->observacionTutInst;

        $asignacion->notaTutorInst = $request->notaTutorInst;

        $asignacion->save();

        return redirect('evidenciasPorValidar');
    }
}