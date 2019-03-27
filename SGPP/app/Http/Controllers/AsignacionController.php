<?php

namespace App\Http\Controllers;

use Auth;
use App\Practica;
use App\Asignacion;
use App\Titulacion;
use App\Institucion;
use App\EstadoAsignacion;
use App\EntradaSeguimiento;
use App\User;
use Illuminate\Http\Request;
use DB;

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

        // Practicas cuya titulación tiene como director al usuario actual
        $practicas = Practica::with("titulacion")
        ->whereHas('titulacion', function($q) use ($usuarioActual){
            $q->where('director_id', $usuarioActual->id);
        })
        ->where('cursoacad_id', $curso->id)
        ->whereHas('criterios')
        ->whereHas('criterioEncuestaPracticas')
        ->get();

        $idsPracticasCompletas = array();

        foreach($practicas as $practica)
        {
            $ponderacionTemp = 0;

            foreach($practica->criterios as $criterio)
            {
                $ponderacionTemp += (int)$criterio->ponderacion;
            }

            if($ponderacionTemp == 100)
            {
                array_push($idsPracticasCompletas, $practica->id);
            }

            $ponderacionTemp = 0;
        }

        $practicas = Practica::with("titulacion")
        ->whereIn('id', $idsPracticasCompletas)
        ->get();

        // Posibles tutores académicos
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
    public function show($id)
    {
        $asignacion = Asignacion::where('id', $id)
        ->with('practica', 'practica.titulacion', 'alumno', 'tutorInst', 'tutorAcad', 
            'estado', 'practica.cursoacad', 'tutorAcad.institucion')
        ->first();

        return view('director.asignaciones.show')->with(['asignacion' => $asignacion]);
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

        $titulacion = Titulacion::where('id', $practicas->titulacion_id)->first();

        $idTitulacion = $titulacion->id;

        if((int)$titulacion->mencion == 1)
        {
            $titulacionPrincipal = Titulacion::where('id', $titulacion->titulacion_principal_id)->first();
            $idTitulacion = $titulacionPrincipal->id;
        }

        $instituciones = Institucion::where('titulacion_id', $idTitulacion)->get();

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

    public function evidencias($id)
    {
        $evidencias = EntradaSeguimiento::where('asignacion_id', $id)->paginate(8);
        $asignacion = Asignacion::with('practica')->where('id', $id)->first();

        return view('director.asignaciones.evidencias')->with(['evidencias' => $evidencias, 'asignacion' => $asignacion]);
    }

    public function evidencia($id)
    {
        $evidencia = EntradaSeguimiento::with('asignacion', 'asignacion.practica')->where('id', $id)->first();

        return view('director.asignaciones.evidencia')->with(['evidencia' => $evidencia]);
    }

    public function valoracionInstitucion($id)
    {
        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion', 'encuestaPracticas')->where('id', $id)->first();
        $practica = Practica::with('criterioEncuestaPracticas')->where('id', $asignacion->practica->id)->first();

        return view('director.asignaciones.valoracionInstitucion')->with(['practica' => $practica, 'asignacion' => $asignacion]);
    }

    public function valoracionPracticas($id)
    {
        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion', 'evaluacions')->where('id', $id)->first();
        $practica = Practica::with('criterios')->where('id', $asignacion->practica->id)->first();

        return view('director.asignaciones.valoracionPractica')->with(['practica' => $practica, 'asignacion' => $asignacion]);
    }
}
