<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TutoresAcademicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleName = 'Tutor Académico';
        $users = User::whereHas('roles', function ($q) use ($roleName) {
            $q->where('nombre', $roleName);
        })->paginate(8);

        return view('director.tutoresAcademicos.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('director.tutoresAcademicos.create');
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

        $user->roles()->attach(Role::where('nombre', 'Tutor Académico')->first());
        
        return redirect('tutoresAcademicos');

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
        $allRoles = Role::orderBy('nombre', 'asc')->get();

        return view('director.tutoresAcademicos.show')->with(['user' => $user]);
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

        return view('director.tutoresAcademicos.edit')->with(['user' => $user]);
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

        $user->roles()->sync($request->role);

        return redirect('tutoresAcademicos');
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
}
