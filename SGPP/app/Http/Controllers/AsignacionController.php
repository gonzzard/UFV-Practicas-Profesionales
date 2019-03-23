<?php

namespace App\Http\Controllers;

use Auth;
use App\Practica;
use App\Asignacion;
use App\Titulacion;
use App\Institucion;
use App\EstadoAsignacion;
use App\User;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = $this->CursoAcadActual();

        $asignaciones = Asignacion::with('practica', 'practica.titulacion', 'practica.cursoacad')
        ->whereHas('practica', function ($query) use ($curso) {
            $query->where('cursoacad_id', $curso->id);
        })
        ->with('alumno')
        ->with('tutorAcad')
        ->with('tutorInst')
        ->with('estado')
        ->paginate(8);

        return view('director.asignaciones.index')->with(['asignaciones' => $asignaciones, 'curso' => $curso]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curso = $this->CursoAcadActual();
        $usuarioActual = Auth::user();

        $practicas = Practica::with("titulacion")
        ->whereHas('titulacion', function($q) use ($usuarioActual){
            $q->where('director_id', $usuarioActual->id);
        })
        ->where('cursoacad_id', $curso->id)
        ->whereHas('criterios')
        ->whereHas('criterioEncuestaPracticas')
        ->get();

        $roleName = "Tutor Académico";

        $tutoresAcad = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })
        ->get();

        return view('director.asignaciones.create')->with(['practicas' => $practicas, 'tutoresAcad' => $tutoresAcad,
            'curso' => $curso]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asignacion = new Asignacion();

        $estadoEnProceso = EstadoAsignacion::where('denominacion', 'EN PROCESO')->first();
        $practica = Practica::where('id', $request->practica_id)->first();
        $alumno = User::where('id', $request->alumno_id)->first();
        $tutorAcad = User::where('id', $request->tacademico_id)->first();
        $tutorInst = User::where('id', $request->tinstitucional_id)->first();

        $asignacion->horasRealizadas= 0;
        $asignacion->notaFinal = -1;
        $asignacion->observacion = "-";
        $asignacion->practica()->associate($practica);
        $asignacion->alumno()->associate($alumno);
        $asignacion->tutorAcad()->associate($tutorAcad);
        $asignacion->tutorInst()->associate($tutorInst);
        $asignacion->estado()->associate($estadoEnProceso);

        $asignacion->save();

        return redirect()->route('asignaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignacion $asignacion)
    {
        //
    }

    public function cambioInst($id)
    {
        $asignacion = Asignacion::with('tutorAcad', 'tutorInst', 'alumno', 'estado', 'practica', 'practica.titulacion')
        ->where('id', $id)
        ->first();

        $roleName = "Tutor Académico";

        $tutoresAcad = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })
        ->get();

        $roleName = "Tutor Institucional";

        $tutoresInst = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })->where('institucion_id', $asignacion->tutorInst->institucion->id)->get();

        $instituciones = Institucion::where('titulacion_id', $asignacion->practica->titulacion->id)->get();

        return view('director.asignaciones.cambioInst')->with(['asignacion' => $asignacion, 'tutoresAcad' => $tutoresAcad,
            'instituciones' => $instituciones, 'tutoresInst' => $tutoresInst]);
    }

    public function cambioInstStore($id, Request $request)
    {
        $asignacionAnt = Asignacion::with('practica', 'alumno')->where('id', $id)->first();

        $estadoEnProceso = EstadoAsignacion::where('denominacion', 'EN PROCESO')->first();
        $estadoCambio = EstadoAsignacion::where('denominacion', 'CAMBIO DE PRACTICAS')->first();

        $practica = Practica::where('id', $asignacionAnt->practica->id)->first();
        $alumno = User::where('id', $asignacionAnt->alumno->id)->first();
        $tutorAcad = User::where('id', $request->tacademico_id)->first();
        $tutorInst = User::where('id', $request->tinstitucional_id)->first();

        $asignacion = new Asignacion();
        $asignacion->horasRealizadas = 0 + $asignacionAnt->horasRealizadas;
        $asignacion->notaFinal = -1;
        $asignacion->observacion = "-";
        $asignacion->practica()->associate($practica);
        $asignacion->alumno()->associate($alumno);
        $asignacion->tutorAcad()->associate($tutorAcad);
        $asignacion->tutorInst()->associate($tutorInst);
        $asignacion->estado()->associate($estadoEnProceso);
        $asignacion->asignacionAnterior()->associate($asignacionAnt);
        $asignacion->save();

        $asignacionAnt->estado()->associate($estadoCambio);
        $asignacionAnt->save();

        return redirect()->route('asignaciones.index');
    }

    public function getInstitucionesTitulacion(Request $request)
    {
        $practicas = Practica::with("titulacion")
            ->where('id', $request->practica_id)->first();

        $instituciones = Institucion::where('titulacion_id', $practicas->titulacion_id)->get();

        return response()->json($instituciones);
    }

    public function getTutoresInstitucion(Request $request)
    {
        $roleName = "Tutor Institucional";

        $tutores = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })->where('institucion_id', $request->institucion_id)->get();
        
        return response()->json($tutores);
    }

    public function getAlumnosPractica(Request $request)
    {
        $curso = $this->CursoAcadActual();

        $roleName = "Alumno";

        $asignaciones = Asignacion::whereHas('practica', function ($query) use ($curso, $request) {
            $query->where('cursoacad_id', $curso->id);
        })
        ->where('practica_id', $request->practica_id)
        ->select('alumno_id')->get()->toArray();

        $alumnos = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })->whereNotIn('id', $asignaciones)->get();

        return response()->json($alumnos);
    }
}
