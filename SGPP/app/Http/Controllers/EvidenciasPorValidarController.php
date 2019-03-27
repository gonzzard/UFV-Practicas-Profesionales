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

class EvidenciasPorValidarController extends Controller
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
        ->with('tutorInst')
        ->with('estado')
        ->with('entradasSeguimiento')
        ->where('tutorInst_id', $usuarioActual->id)
        ->select('id')
        ->get()
        ->ToArray();

        $evidencias = EntradaSeguimiento::with('asignacion', 'asignacion.alumno', 'asignacion.practica', 'asignacion.estado',
        'asignacion.practica.titulacion')
        ->where('comprobado', false)
        ->paginate(8);

        return view('tutorInst.EvidenciasPendientes.index')->with(['evidencias' => $evidencias]);
    }

    public function evidencia($id)
    {
        $evidencia = EntradaSeguimiento::where('id', $id)
        ->with('asignacion', 'asignacion.practica', 'asignacion.alumno', 'asignacion.tutorAcad', 'asignacion.tutorInst',
            'asignacion.practica.titulacion')
        ->first();

        return view('tutorInst.EvidenciasPendientes.validarEvidencia')->with(['evidencia' => $evidencia]);
    }
    
    public function validarEvidencia(Request $request)
    {
        $evidencia= EntradaSeguimiento::where('id', $request->asignacion_id)->with('asignacion')->first();

        if(isset($request->validar) && $request->validar == "on")
        {
            $evidencia->validado = true;
        }
        else 
        {
            $evidencia->validado = false;
        }

        $evidencia->comprobado = true;

        $evidencia->save();

        if($evidencia->validado == true)
        {
            $asignacion = Asignacion::where('id', $evidencia->asignacion->id)->with('practica')->first();

            $asignacion->horasRealizadas += $evidencia->horasRealizadas;

            if($asignacion->horasRealizadas >= $asignacion->practica->horasTotales)
            {
                $estadoTerminado = EstadoAsignacion::where('denominacion', 'TERMINADA')->first();
                $asignacion->estado()->associate($estadoTerminado);
            }
            $asignacion->save();
        }

        return redirect('evidenciasPorValidar');
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
        ->where('tutorInst_id', $usuarioActual->id)
        ->paginate(8);

        return view('tutorInst.practicas.index')->with(['asignaciones' => $asignaciones, 'curso' => $curso]);
    }

    public function evidenciasPractica($id)
    {
        $evidencias = EntradaSeguimiento::where('asignacion_id', $id)->paginate(8);
        $asignacion = Asignacion::with('practica')->where('id', $id)->first();

        return view('tutorInst.practicas.evidencias')->with(['evidencias' => $evidencias, 'asignacion' => $asignacion]);
    }

    public function evidenciaPractica($id)
    {
        $evidencia = EntradaSeguimiento::with('asignacion', 'asignacion.practica')->where('id', $id)->first();

        return view('tutorInst.practicas.evidencia')->with(['evidencia' => $evidencia]);
    }

    public function show($id)
    {
        $asignacion = Asignacion::where('id', $id)
        ->with('practica', 'practica.titulacion', 'alumno', 'tutorInst', 'tutorAcad', 
            'estado', 'practica.cursoacad', 'tutorAcad.institucion')
        ->first();

        return view('tutorInst.practicas.show')->with(['asignacion' => $asignacion]);
    }
}