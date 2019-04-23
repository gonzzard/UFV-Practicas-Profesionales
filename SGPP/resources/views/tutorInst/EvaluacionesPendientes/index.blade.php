@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Evaluaciones pendientes</h2>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(count($asignaciones) > 0)
            <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-practica"></i> Alumno</th>
                                    <th scope="col"><i class="fas fa-unlock-alt"></i> Práctica</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach ($asignaciones as $asignacion)
                            <tr>
                                <td scope="row">{{ $asignacion->alumno->name}}</td>
                                <td scope="row">{{ $asignacion->practica->denominacion}}</td>
                                <td scope="row">
                                    <div class="btn-group btn-group-justified" style="float:right;">
                                        <button class="btn btn-info" type="button" title="Ver evidencia" onclick="window.location='{{ route('tutorInst.evaluaciones.evaluacion', $asignacion->id) }}'"><i
                                                class="fa fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $asignaciones->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div style="text-align:center">No hay evaluaciones pendientes.</div>
            @endif
        </div>
    </div>
</div>
@endsection