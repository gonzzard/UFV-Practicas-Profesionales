<?php

namespace App\Http\Controllers;

use App\CriterioEncuestaPractica;
use App\Practica;
use Illuminate\Http\Request;
use App\Http\Controllers\Redirect;

class CriterioEncuestaPracticaController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $criterios = CriterioEncuestaPractica::with('practica', 'practica.asignaciones')
        ->where('practica_id', $id)->paginate(8);

        $practica = Practica::where('id', $id)->first();

        return view('director.criteriosEncuesta.index')->with(['criterios' => $criterios, 'practica'=> $practica]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $criterios = CriterioEncuestaPractica::where('practica_id', $id)->get();

        $practica = Practica::with("titulacion", "titulacion.titulacionPrincipal")
        ->where('id', $id)->first();

        return view('director.criteriosEncuesta.create')->with(['criterios' => $criterios, 'practica'=> $practica]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $practica = Practica::where('id', $request->practica_id)->first();

        $criterio = new CriterioEncuestaPractica();
        $criterio->denominacion = $request->criterio;

        $criterio->practica()->associate($practica);
        $criterio->save();

        return redirect(route('criteriosEncuesta.index', $practica->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Criterio  $criterio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $criterio = CriterioEncuestaPractica::with('practica', 'practica.titulacion')->where('id', $id)->first();

        return view('director.criteriosEncuesta.show')->with(['criterio' => $criterio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Criterio  $criterio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $criterio = CriterioEncuestaPractica::with('practica', 'practica.titulacion')->where('id', $id)->first();

        return view('director.criteriosEncuesta.edit')->with(['criterio' => $criterio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Criterio  $criterio
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $criterio = CriterioEncuestaPractica::where('id', $id)->first();

        $criterio->denominacion = $request->criterio;

        $criterio->save();

        return redirect(route('criteriosEncuesta.index', $criterio->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Criterio  $criterio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criterio $criterio)
    {
        //
    }
}
