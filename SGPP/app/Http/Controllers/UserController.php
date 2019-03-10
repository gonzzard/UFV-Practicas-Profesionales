<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(2);
        return view('admin.user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::All();
        return view('admin.user.create')->with(['roles' => $roles]);
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

        foreach ($request['role'] as $role) {
            $user->roles()->attach(Role::where('id', $role)->first());
        }

        return redirect('user');

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

        return view('admin.user.show')->with(['user' => $user, 'allRoles' => $allRoles]);
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
        $allRoles = Role::orderBy('nombre', 'asc')->get();

        return view('admin.user.edit')->with(['user' => $user, 'allRoles' => $allRoles]);
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

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (isset($user)) {
            $tmp = $user->name;

            $user->roles()->detach();
            $user->delete();

            Session::flash('user.destroy', 'El usuario ' . $tmp . ' ha sido eliminado del sistema');
            return redirect('user');
        } else {
            return redirect('404');
        }
    }
}
