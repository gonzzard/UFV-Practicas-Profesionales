<?php

namespace App\Http\Controllers;

use App\Cursoacad;
use Illuminate\Http\Request;

class CursoacadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursosacad = Cursoacad::orderBy('denominacion', 'DESC')->paginate(8);
        return view('admin.cursoacad.index')->with(['cursosacad' => $cursosacad]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cursoacad.create');
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
            'denominacion' => ['required', 'string', 'unique:cursoacads'],
        ]);

        $cursoacad = new Cursoacad();
        $cursoacad->denominacion = $request['denominacion'];
        $cursoacad->activo = 0;

        if(isset($request['activo']))
        {
            $cursoacadActivo = Cursoacad::where('activo', 1)->first();
            $cursoacadActivo->activo = 0;
            $cursoacad->activo = 1;
            $cursoacadActivo->save();
        }

        $cursoacad->save();

        return redirect('cursoacad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cursoacad  $cursoacad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cursoacad = Cursoacad::where('id', $id)->first();
        return view('admin.cursoacad.show')->with(['cursoacad' => $cursoacad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cursoacad  $cursoacad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursoacad = Cursoacad::where('id', $id)->first();
        return view('admin.cursoacad.edit')->with(['cursoacad' => $cursoacad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cursoacad  $cursoacad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'denominacion' => ['required', 'string', 'unique:cursoacads'],
        ]);
        
        $cursoacad = Cursoacad::where('id', $request['id_curso'])->first();
        $cursoacad->denominacion = $request['denominacion'];
        $cursoacad->activo = 0;

        if(isset($request['activo']))
        {
            $cursoacadActivo = Cursoacad::where('activo', 1)->first();
            $cursoacadActivo->activo = 0;
            $cursoacad->activo = 1;
            $cursoacadActivo->save();
        }

        $cursoacad->save();

        return redirect('cursoacad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cursoacad  $cursoacad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cursoacad $cursoacad)
    {
        //
    }
}
