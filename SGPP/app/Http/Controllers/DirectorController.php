<?php

namespace App\Http\Controllers;

use App\User;
use App\Titulacion;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directores = User::whereHas('titulacion')->paginate(8);
        return view('admin.directores.index')->with(['directores' => $directores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulaciones = Titulacion::where('mencion', 0)->whereNull('director_id')->get();

        $roleName = "Director de Grado";

        $usuarios = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })
        ->doesntHave('titulacion')
        ->get();

        return view('admin.directores.create')->with(['titulaciones' => $titulaciones, 'usuarios' => $usuarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $director = User::where('id', $request['profesor_id'])->first();
        $titulacion = Titulacion::where('id', $request['titulacion_id'])->first();
        $titulacion->director()->associate($director)->save();
        $titulacion->save();

        return redirect('directores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cursoacad  $cursoacad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $titulaciones = Titulacion::where('mencion', 0)->where(function ($query)  use ($id) {
            $query->whereNull('director_id')
                  ->orWhere('director_id', $id);
        })->get();

        $directorSeleccionado = User::where('id', $id)->first();
        $titulacionSeleccionada = Titulacion::where('director_id', $id)->first();

        return view('admin.directores.edit')->with(['titulaciones' => $titulaciones,
            'directorSeleccionado' => $directorSeleccionado, 'titulacionSeleccionada' => $titulacionSeleccionada ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request['tit_anterior'] != $request['titulacion_id'])
        {
            $director = User::where('id', $id)->first();

            $titulacion_anterior = Titulacion::where('id', $request['tit_anterior'])->first();
            $titulacion_anterior->director()->dissociate()->save();
            $titulacion_anterior->save();

            $titulacion_nueva = Titulacion::where('id', $request['titulacion_id'])->first();
            $titulacion_nueva->director()->associate($director)->save();
            $titulacion_nueva->save();
        }

        return redirect('directores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $titulacion_anterior = Titulacion::where('id', $id)->first();
        $titulacion_anterior->director()->dissociate()->save();
        $titulacion_anterior->save();
        return redirect('directores');
    }
}
