<?php

namespace App\Http\Controllers;

use App\Asignacion;
use App\CriterioEncuestaPractica;
use App\EncuestaPracticas;
use App\EntradaSeguimiento;
use App\Practica;
use App\User;
use Auth;
use Illuminate\Http\Request;
use PDF;

class PracticasAlumnoController extends Controller
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
            ->where('alumno_id', $usuarioActual->id)
            ->paginate(8);

        return view('alumno.practicasAlumno.index')->with(['asignaciones' => $asignaciones, 'curso' => $curso]);
    }

    public function evidencias($id)
    {
        $evidencias = EntradaSeguimiento::where('asignacion_id', $id)->paginate(8);
        $asignacion = Asignacion::with('practica')->where('id', $id)->first();

        return view('alumno.practicasAlumno.evidencias')->with(['evidencias' => $evidencias, 'asignacion' => $asignacion]);
    }

    public function createEvidencia($id)
    {
        $asignacion = Asignacion::with('practica')->where('id', $id)->first();

        return view('alumno.practicasAlumno.create')->with(['asignacion' => $asignacion]);
    }

    public function showEvidencia($id)
    {
        $evidencia = EntradaSeguimiento::with('asignacion', 'asignacion.practica')->where('id', $id)->first();

        return view('alumno.practicasAlumno.show')->with(['evidencia' => $evidencia]);
    }

    public function storeEvidencia(Request $request)
    {
        $asignacion = Asignacion::with('practica')->where('id', $request->asignacion_id)->first();

        $evidencia = new EntradaSeguimiento();

        $evidencia->actividad = $request->actividad;
        $evidencia->observacion = $request->observacion;
        $evidencia->urlEvidencias = $request->url;
        $evidencia->horasRealizadas = $request->horas;
        $evidencia->validado = false;
        $evidencia->comprobado = false;
        $asignacion->entradasSeguimiento()->save($evidencia);
        $evidencia->save();

        return redirect()->route(
            'alumno.practicasAlumno.evidencias', ['id' => $asignacion->id]
        );
    }

    public function valorarInstitucion($id)
    {
        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion', 'encuestaPracticas')->where('id', $id)->first();
        $practica = Practica::with('criterioEncuestaPracticas')->where('id', $asignacion->practica->id)->first();

        return view('alumno.practicasAlumno.valorarInstitucion')->with(['practica' => $practica, 'asignacion' => $asignacion]);
    }

    public function valorarInstitucionStore($id, Request $request)
    {
        $asignacion = Asignacion::with('practica')->with('tutorInst', 'tutorInst.institucion')->where('id', $id)->first();

        foreach ($request->criterio as $criterio) {
            $nota = (int) $criterio["valor"];
            $criterio = CriterioEncuestaPractica::where('id', $criterio["id"])->first();
            $encuesta = new EncuestaPracticas();
            $encuesta->nota = $nota;
            $encuesta->criterioEncuestaPracticas()->associate($criterio);
            $encuesta->asignacion()->associate($asignacion);
            $encuesta->observacion = "";
            $encuesta->save();
        }

        return redirect()->route(
            'alumno.practicasAlumno.evidencias', ['id' => $asignacion->id]
        );
    }

    public function certificados()
    {
        $curso = $this->CursoAcadActual();
        $usuarioActual = Auth::user();

        $asignaciones = Asignacion::with('practica', 'practica.titulacion', 'practica.cursoacad')
            ->whereHas('practica', function ($query) use ($curso) {
                $query->where('cursoacad_id', $curso->id);
            })
            ->whereHas('estado', function ($query) use ($curso) {
                $query->where('denominacion', "TERMINADA");
            })
            ->with('alumno')
            ->with('tutorAcad')
            ->with('tutorInst', 'tutorInst.institucion')
            ->where('alumno_id', $usuarioActual->id)
            ->where('notaFinal', '!=', -1)
            ->paginate(8);

        return view('alumno.certificados.index')->with(['asignaciones' => $asignaciones, 'curso' => $curso]);
    }

    public function descargaCertificado($id)
    {
        $asignacion = Asignacion::with('alumno', 'tutorAcad', 'tutorInst', 'practica', 'practica.titulacion', 'practica.titulacion.titulacionPrincipal')
            ->where('id', $id)->first();

        $notaText = "";

        if ($asignacion->notaFinal >= 900) {
            $notaText = "SOBRESALIENTE";
        } else if ($asignacion->notaFinal >= 700) {
            $notaText = "NOTABLE";
        } else {
            $notaText = "APROBADO";
        }

        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');

        $fecha = getdate();

        $a[1] = "Enero";
        $a[2] = "Febrero";
        $a[3] = "Marzo";
        $a[4] = "Abril";
        $a[5] = "Mayo";
        $a[6] = "Junio";
        $a[7] = "Julio";
        $a[8] = "Agosto";
        $a[9] = "Septiembre";
        $a[10] = "Octubre";
        $a[11] = "Noviembre";
        $a[12] = "Diciembre";

        $director = User::where('id', $asignacion->practica->titulacion->director_id)->first();

        $data = ['alumno' => ($asignacion->alumno->name . " " . $asignacion->alumno->apellido1 . " " . $asignacion->alumno->apellido2),
            'practica' => $asignacion->practica, 'notaText' => $notaText, 'asignacion' => $asignacion,
            'dia' => $fecha["mday"], 'mes' => $a[$fecha["mon"]], 'anyo' => $fecha["year"],
            'director' => ($director->name . " " . $director->apellido1 . " " . $director->apellido2), 'titulacion' => $asignacion->practica->titulacion];

        $pdf = PDF::loadView('pdf/Certificado', $data);

        return $pdf->download('Certificado.pdf');
    }
}
