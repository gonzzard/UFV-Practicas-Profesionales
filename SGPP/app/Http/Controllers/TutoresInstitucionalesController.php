<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\User;
use App\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TutoresInstitucionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioActual = User::with('titulacion')->where('id', Auth::user()->id)->first();;

        $instituciones = Institucion::where('titulacion_id', $usuarioActual->titulacion->id)
        ->select('id')->get()->ToArray();

        $roleName = 'Tutor Institucional';

        $users = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })
        ->whereIn('institucion_id', $instituciones)
        ->paginate(8);

        return view('director.tutoresInstitucionales.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarioActual = User::with('titulacion')->where('id', Auth::user()->id)->first();;

        $instituciones = Institucion::where('titulacion_id', $usuarioActual->titulacion->id)->get();

        return view('director.tutoresInstitucionales.create')->with(['instituciones' => $instituciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleName = 'Tutor Institucional';

        $institucion = Institucion::where('id', $request->institucion_id)->first();
        
        if ($request->buscado == "si") {
            $tutorInst = User::where('docIdentificacion', $request->docIdentificacion)->first();
            $tutorInst->roles()->attach(Role::where('nombre', $roleName)->first());
            $tutorInst->institucion()->associate($institucion);
            $tutorInst->save();
        } 
        else 
        {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'apellido1' => ['required', 'string', 'max:255'],
                'apellido2' => ['required', 'string', 'max:255'],
                'docIdentificacion' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'apellido1' => $request['apellido1'],
                'apellido2' => $request['apellido2'],
                'docIdentificacion' => $request['docIdentificacion'],
                'password' => Hash::make($request['password']),
            ]);

            $user->roles()->attach(Role::where('nombre', $roleName)->first());
            $user->institucion()->associate($institucion);
            $user->save();
        }

        return redirect('tutoresInstitucionales');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('roles')->get()->first();

        $usuarioActual = User::with('titulacion')->where('id', Auth::user()->id)->first();;

        $instituciones = Institucion::where('titulacion_id', $usuarioActual->titulacion->id)->get();

        return view('director.tutoresInstitucionales.show')->with(['user' => $user, 'instituciones' => $instituciones]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('roles')->get()->first();

        $usuarioActual = User::with('titulacion')->where('id', Auth::user()->id)->first();;

        $instituciones = Institucion::where('titulacion_id', $usuarioActual->titulacion->id)->get();

        return view('director.tutoresInstitucionales.edit')->with(['user' => $user, 'instituciones' => $instituciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $institucion = Institucion::where('id', $request->institucion_id)->first();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido1' => ['required', 'string', 'max:255'],
            'apellido2' => ['required', 'string', 'max:255'],
        ]);

        if ($user->email != $request['email']) {
            $validatedData = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        if ($user->docIdentificacion != $request['docIdentificacion']) {
            $validatedData = $request->validate([
                'docIdentificacion' => ['required', 'string', 'max:255', 'unique:users'],
            ]);
        }

        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->apellido1 = $request['apellido1'];
        $user->apellido2 = $request['apellido2'];
        $user->docIdentificacion = $request['docIdentificacion'];

        $user->save();

        return redirect('tutoresInstitucionales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function getUsuarioByDocumento(Request $request)
    {
        $admins = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('nombre', 'Administrador');
        })->select('id')->get()->toArray();

        $alumnos = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('nombre', 'Alumno');
        })->select('id')->get()->toArray();

        $tutoresInst = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('nombre', 'Tutor Institucional');
        })->select('id')->get()->toArray();

        $posiblesTutores = User::where('docIdentificacion', $request->docIdentificacion)
            ->whereNotIn('id', $alumnos)
            ->whereNotIn('id', $tutoresInst)
            ->get();

        return response()->json($posiblesTutores);
    }
}
