<?php

namespace App\Http\Controllers;

use App\Criterio;
use App\Practica;
use Illuminate\Http\Request;
use App\Http\Controllers\Redirect;

class CriterioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $criterios = Criterio::with('practica', 'practica.asignaciones')
        ->where('practica_id', $id)->paginate(8);

        $cantidadPonderada = 0;

        $practica = Practica::where('id', $id)->first();

        foreach ($criterios as $criterio)
        {
            $cantidadPonderada += $criterio->ponderacion;
        }

        return view('director.criteriosEvaluacion.index')->with(['criterios' => $criterios, 'cantidadPonderada' => $cantidadPonderada,
            'practica'=> $practica]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $criterios = Criterio::where('practica_id', $id)->get();

        $cantidadPonderadaRestante = 100;

        $practica = Practica::with("titulacion", "titulacion.titulacionPrincipal")
        ->where('id', $id)->first();

        foreach ($criterios as $criterio)
        {
            $cantidadPonderadaRestante -= $criterio->ponderacion;
        }

        return view('director.criteriosEvaluacion.create')->with(['criterios' => $criterios, 'cantidadPonderadaRestante' => $cantidadPonderadaRestante,
        'practica'=> $practica]);
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

        $criterio = new Criterio();
        $criterio->denominacion = $request->criterio;
        $criterio->ponderacion = $request->ponderacion;

        $criterio->practica()->associate($practica);
        $criterio->save();

        
        return redirect(route('criteriosEvaluacion.index', $practica->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Criterio  $criterio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $criterioEdit = Criterio::where('id', $id)
        ->with('practica', 'practica.titulacion')
        ->first();

        $criterios = Criterio::where('practica_id', $criterioEdit->practica->id)->get();

        $cantidadPonderadaRestante = 100;

        $practica = Practica::with("titulacion", "titulacion.titulacionPrincipal")
        ->where('id', $id)->first();

        foreach ($criterios as $criterio)
        {
            $cantidadPonderadaRestante -= $criterio->ponderacion;
        }

        $ponderacionMax = $cantidadPonderadaRestante + $criterioEdit->ponderacion;

        return view('director.criteriosEvaluacion.show')->with(['criterio' => $criterioEdit, 
        'cantidadPonderadaRestante' => $cantidadPonderadaRestante,
        'ponderacionMax' => $ponderacionMax]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Criterio  $criterio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $criterioEdit = Criterio::where('id', $id)
        ->with('practica', 'practica.titulacion')
        ->first();

        $criterios = Criterio::where('practica_id', $criterioEdit->practica->id)->get();

        $cantidadPonderadaRestante = 100;

        $practica = Practica::with("titulacion", "titulacion.titulacionPrincipal")
        ->where('id', $id)->first();

        foreach ($criterios as $criterio)
        {
            $cantidadPonderadaRestante -= $criterio->ponderacion;
        }

        $ponderacionMax = $cantidadPonderadaRestante + $criterioEdit->ponderacion;

        return view('director.criteriosEvaluacion.edit')->with(['criterio' => $criterioEdit, 
        'cantidadPonderadaRestante' => $cantidadPonderadaRestante,
        'ponderacionMax' => $ponderacionMax]);
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
        $criterio = Criterio::with('practica')->where('id', $id)->first();

        $criterio->denominacion = $request->criterio;
        $criterio->ponderacion = $request->ponderacion;

        $criterio->save();

        return redirect(route('criteriosEvaluacion.index', $criterio->practica->id));
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
