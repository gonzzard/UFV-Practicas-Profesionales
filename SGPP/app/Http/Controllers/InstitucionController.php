<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\User;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institucion::with('responsable')->orderBy('denominacion', 'DESC')->paginate(8);
        return view('director.instituciones.index')->with(['instituciones' => $instituciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleName = "Tutor Institucional";

        $responsablesActuales = Institucion::whereNotNull('responsable_id')->select('responsable_id')->get()->toArray();
            
        $posiblesResponsables = User::whereNotIn('id', $responsablesActuales)->whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })
        ->get();

        return view('director.instituciones.create')->with(['responsables' => $posiblesResponsables]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'denominacion' => ['required', 'string', 'unique:institucions'],
        ]);

        $institucion = new Institucion();
        $institucion->denominacion = $request['denominacion'];
        $institucion->direccion = $request['direccion'];
        $institucion->telefono = $request['telefono'];

        $responsable = User::where('id', $request['responsable_id'])->first();

        $institucion->responsable()->associate($responsable)->save();

        $institucion->save();

        return redirect('instituciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roleName = "Tutor Institucional";

        $institucion = Institucion::where('id', $id)->first();

        if(isset($institucion->responsable))
        {
            // Tiene responsable
            $responsablesActuales = Institucion::where('responsable_id', '<>', $institucion->responsable->id)
            ->select('responsable_id')->get()->toArray();

            $posiblesResponsables = User::whereNotIn('id', $responsablesActuales)->whereHas('roles', function ($q) use ($roleName) {
                $q->where('nombre', $roleName);
            })
            ->get();
        }
        else
        {
            // No tiene responsable
            $responsablesActuales = Institucion::whereNotNull('responsable_id')->select('responsable_id')->get()->toArray();
            
            $posiblesResponsables = User::whereNotIn('id', $responsablesActuales)->whereHas('roles', function ($q) use ($roleName) {
                $q->where('nombre', $roleName);
            })
            ->get();
        }

        return view('director.instituciones.show')->with(['institucion' => $institucion, 'responsables' => $posiblesResponsables]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roleName = "Tutor Institucional";

        $institucion = Institucion::where('id', $id)->first();

        if(isset($institucion->responsable))
        {
            // Tiene responsable
            $responsablesActuales = Institucion::where('responsable_id', '<>', $institucion->responsable->id)
            ->select('responsable_id')->get()->toArray();

            $posiblesResponsables = User::whereNotIn('id', $responsablesActuales)->whereHas('roles', function ($q) use ($roleName) {
                $q->where('nombre', $roleName);
            })
            ->get();
        }
        else
        {
            // No tiene responsable
            $responsablesActuales = Institucion::whereNotNull('responsable_id')->select('responsable_id')->get()->toArray();
            
            $posiblesResponsables = User::whereNotIn('id', $responsablesActuales)->whereHas('roles', function ($q) use ($roleName) {
                $q->where('nombre', $roleName);
            })
            ->get();
        }

        return view('director.instituciones.edit')->with(['institucion' => $institucion, 'responsables' => $posiblesResponsables]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $institucion = Institucion::where('id', $id)->first();

        if($request['denominacion'] != $institucion->denominacion)
        {
            $validatedData = $request->validate([
                'denominacion' => ['required', 'string', 'unique:institucions'],
            ]);
        }
        
        $institucion->denominacion = $request['denominacion'];
        $institucion->direccion = $request['direccion'];
        $institucion->telefono = $request['telefono'];

        $responsable = User::where('id', $request['responsable_id'])->first();

        $institucion->responsable()->associate($responsable)->save();

        $institucion->save();

        return redirect('instituciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institucion $institucion)
    {
        //
    }
}
