<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Asignacion;
use App\Practica;
use App\Criterio;
use App\Evaluacion;
use App\EntradaSeguimiento;

class EvaluarPracticasController extends Controller
{
    public function evaluacionesPendientes()
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
            ->where('tutorAcad_id', $usuarioActual->id)
            ->whereHas('estado', function ($query) {
                $query->where('denominacion', 'TERMINADA');
            })
            ->where('notaFinal', -1)
            ->where('notaTutorInst','>', -1)
            ->where('horasRealizadas', '>=', 'practica.horasTotales')
            ->paginate(8);

        return view('tutorAcad.evaluaciones.index')->with(['asignaciones' => $asignaciones, 'curso' => $curso]);
    }

    public function evaluarPractica($id)
    {
        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion', 'evaluacions')->where('id', $id)->first();
        $practica = Practica::with('criterios')->where('id', $asignacion->practica->id)->first();

        return view('tutorAcad.evaluaciones.evaluarPractica')->with(['practica' => $practica, 'asignacion' => $asignacion]);
    }

    public function evaluacionStore($id, Request $request)
    {

        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion')->where('id', $id)->first();

        $notaFinal = 0;

        foreach ($request->criterio as $criterio) 
        {
            $nota = $criterio["valor"];
            $criterio = Criterio::where('id', $criterio["id"])->first();
            $evaluacion = new Evaluacion();
            $evaluacion->nota = $nota;
            $evaluacion->criterio()->associate($criterio);
            $evaluacion->asignacion()->associate($asignacion);
            $evaluacion->observacion = "";
            $evaluacion->save();

            $notaFinal += $criterio->ponderacion * $evaluacion->nota;
        }

        $asignacion->notaFinal = $notaFinal;
        $asignacion->save();

        return redirect()->route('tutorAcad.evaluaciones.index');
    }

    public function evidencias($id)
    {
        $evidencias = EntradaSeguimiento::where('asignacion_id', $id)->paginate(8);
        $asignacion = Asignacion::with('practica')->where('id', $id)->first();

        return view('tutorAcad.practicas.evidencias')->with(['evidencias' => $evidencias, 'asignacion' => $asignacion]);
    }

    public function evidencia($id)
    {
        $evidencia = EntradaSeguimiento::where('id', $id)
        ->with('asignacion', 'asignacion.practica', 'asignacion.alumno', 'asignacion.tutorAcad', 'asignacion.tutorInst',
            'asignacion.practica.titulacion')
        ->first();

        return view('tutorAcad.practicas.evidencia')->with(['evidencia' => $evidencia]);
    }

    public function practicas()
    {
        $curso = $this->CursoAcadActual();
        $usuarioActual = Auth::user();

        $asignaciones = Asignacion::with('practica', 'practica.titulacion', 'practica.cursoacad')
        ->whereHas('practica', function ($query) use ($curso) {
            $query->where('cursoacad_id', $curso->id);
        })
        ->with('alumno')
        ->with('tutorAcad')
        ->with('tutorInst')
        ->with('estado')
        ->where('tutorAcad_id', $usuarioActual->id)
        ->paginate(8);

        return view('tutorAcad.practicas.index')->with(['asignaciones' => $asignaciones, 'curso' => $curso]);
    }

    public function evidenciasPractica($id)
    {
        $evidencias = EntradaSeguimiento::where('asignacion_id', $id)->paginate(8);
        $asignacion = Asignacion::with('practica')->where('id', $id)->first();

        return view('tutorAcad.practicas.evidencias')->with(['evidencias' => $evidencias, 'asignacion' => $asignacion]);
    }

    public function evidenciaPractica($id)
    {
        $evidencia = EntradaSeguimiento::with('asignacion', 'asignacion.practica')->where('id', $id)->first();

        return view('tutorAcad.practicas.evidencia')->with(['evidencia' => $evidencia]);
    }

    public function show($id)
    {
        $asignacion = Asignacion::where('id', $id)
        ->with('practica', 'practica.titulacion', 'alumno', 'tutorInst', 'tutorAcad', 
            'estado', 'practica.cursoacad', 'tutorAcad.institucion')
        ->first();

        return view('tutorAcad.practicas.show')->with(['asignacion' => $asignacion]);
    }

    public function valoracionPracticas($id)
    {
        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion', 'evaluacions')->where('id', $id)->first();
        $practica = Practica::with('criterios')->where('id', $asignacion->practica->id)->first();

        return view('tutorAcad.practicas.valoracionPractica')->with(['practica' => $practica, 'asignacion' => $asignacion]);
    }
}
