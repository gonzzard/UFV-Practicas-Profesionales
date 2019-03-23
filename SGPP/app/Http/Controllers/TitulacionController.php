<?php

namespace App\Http\Controllers;

use App\Titulacion;
use Illuminate\Http\Request;

class TitulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulacion = Titulacion::with('titulacionPrincipal', 'titulacionPrincipal.director', 'director')->orderBy('denominacion', 'ASC')->paginate(8);
        return view('admin.titulaciones.index')->with(['titulacion' => $titulacion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulaciones = Titulacion::where('mencion', 0)->orderBy('denominacion', 'ASC')->get();
        return view('admin.titulaciones.create')->with(['titulaciones' => $titulaciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titulacion = new Titulacion();
        $titulacion->denominacion = $request['denominacion'];
        $titulacion->mencion = 0;

        if (isset($request['titulacion_principal_id']) && $request['titulacion_principal_id'] != null) {
            $titulacion_principal = Titulacion::where('id', $request['titulacion_principal_id'])->first();
            $titulacion->titulacionPrincipal()->associate($titulacion_principal);
            $titulacion->mencion = 1;
            $titulacion->director()->associate($titulacion_principal);
        }

        $titulacion->save();

        return redirect('titulaciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $titulacion = Titulacion::where('id', $id)->first();
        $menciones = Titulacion::where('titulacion_principal_id', $id)->get();
        $titulacion_principal = Titulacion::where('id', $titulacion->titulacion_principal_id)->first();

        return view('admin.titulaciones.show')->with(['titulacion' => $titulacion, 'menciones' => $menciones,
            'titulacion_principal' => $titulacion_principal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $titulacion = Titulacion::where('id', $id)->first();
        $tit_principal = Titulacion::where('titulacion_principal_id', $id)->first();
        $tit_principales = Titulacion::where('mencion', 0)->orderBy('denominacion', 'DESC')->get();
        return view('admin.titulaciones.edit')->with(['titulacion' => $titulacion, 'tit_principales' => $tit_principales,
            'tit_principal' => $tit_principal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $titulacion = Titulacion::where('id', $id)->first();
        $titulacion->denominacion = $request['denominacion'];
        $titulacion->mencion = 0;

        if (isset($request['titulacion_principal_id']) && $request['titulacion_principal_id'] != null) {
            $titulacion_principal = Titulacion::where('id', $request['titulacion_principal_id'])->first();
            $titulacion->titulacionPrincipal()->associate($titulacion_principal);
            $titulacion->mencion = 1;
            $titulacion->director()->associate($titulacion_principal);
        }

        $titulacion->save();

        return redirect('titulaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Titulacion  $titulacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Titulacion $titulacion)
    {
        //
    }
}
