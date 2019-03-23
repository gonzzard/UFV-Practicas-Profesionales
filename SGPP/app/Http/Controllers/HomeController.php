<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Asignacion;
use App\EntradaSeguimiento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        ->with('tutorInst')
        ->with('estado')
        ->with('entradasSeguimiento')
        ->where('tutorInst_id', $usuarioActual->id)
        ->select('id')
        ->get()
        ->ToArray();

        $evidencias = EntradaSeguimiento::with('asignacion', 'asignacion.alumno', 'asignacion.practica', 'asignacion.estado',
        'asignacion.practica.titulacion')
        ->where('comprobado', false)->get();
        
        return view('home')->with(['evidenciasPendientes' => count($evidencias)]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","La contraseña actual no coincide con la contraseña introducida. Pruebe de nuevo.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","La nueva contraseña no puede ser igual que tu contraseña actual. Pruebe de nuevo.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Contraseña cambiada satisfactoriamente.");
    }
}
