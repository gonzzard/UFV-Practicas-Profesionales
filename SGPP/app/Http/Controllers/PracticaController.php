<?php

namespace App\Http\Controllers;

use Auth;
use App\Practica;
use App\Titulacion;
use Illuminate\Http\Request;

class PracticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $director = Auth::user();

        $cursoActual = $this->CursoAcadActual();
        
        $titulacionesDirector = Titulacion::where('director_id', $director->id)
        ->select('id')->get()->toArray();

        $practicas = Practica::with('cursoacad')
        ->with('titulacion')
        ->with('criterios')
        ->with('asignaciones')
        ->whereIn('titulacion_id', $titulacionesDirector)
        ->where('cursoacad_id', $cursoActual->id)
        ->orderBy('denominacion', 'ASC')
        ->paginate(8);

        return view('director.practicas.index')->with(['practicas' => $practicas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curso = $this->CursoAcadActual();

        $titulacionConPracticas_id = Practica::where('cursoacad_id', $curso->id)
        ->whereNotNull('titulacion_id')
        ->select('titulacion_id')
        ->get()->toArray();

        $director = Auth::user();

        $titulacionesDirector = Titulacion::where('director_id', $director->id)
        ->select('id')->get()->toArray();

        $titulaciones = Titulacion::whereNotIn('id', $titulacionConPracticas_id)
        ->whereIn('id', $titulacionesDirector)
        ->orderBy('denominacion', 'ASC')
        ->get();

        return view('director.practicas.create')->with(['titulaciones' => $titulaciones, 'curso' => $curso]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso = $this->CursoAcadActual();
        $titulacion = Titulacion::where('id', $request->titulacion_id)->first();

        $practica = new Practica();
        $practica->denominacion = $request->denominacion;
        $practica->creditos = $request->creditos;
        $practica->horasCredito = $request->horasCredito;
        $practica->horasTotales = $practica->horasCredito * $practica->creditos;
        $practica->cursoacad()->associate($curso);
        $practica->titulacion()->associate($titulacion);

        $practica->save();

        return redirect('practicas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practica  $practica
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $practica = Practica::with('titulacion', 'cursoacad', 'titulacion.titulacionPrincipal')->where('id', $id)->first();

        return view('director.practicas.show')->with(['practica' => $practica]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practica  $practica
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $practica = Practica::with('titulacion', 'cursoacad', 'titulacion.titulacionPrincipal')->where('id', $id)->first();

        return view('director.practicas.edit')->with(['practica' => $practica]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Practica  $practica
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $practica = Practica::where('id', $id)->first();

        $practica->denominacion = $request->denominacion;

        $practica->save();

        return redirect('practicas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Practica  $practica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Practica $practica)
    {
        //
    }
}
