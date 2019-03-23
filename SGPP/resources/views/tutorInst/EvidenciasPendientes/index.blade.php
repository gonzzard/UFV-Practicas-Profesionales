@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Evidencias pendientes de validar</h2>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(count($evidencias) > 0)
            <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-practica"></i> Alumno</th>
                                    <th scope="col"><i class="fas fa-envelope"></i> Horas</th>
                                    <th scope="col"><i class="fas fa-unlock-alt"></i> Práctica</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach ($evidencias as $evidencia)
                            <tr>
                                <td scope="row">{{ $evidencia->asignacion->alumno->name}}</td>
                                <td scope="row">{{ $evidencia->horasRealizadas}}</td>
                                <td scope="row">{{ $evidencia->asignacion->practica->denominacion}}</td>
                                <td scope="row">
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Evidencias" onclick="window.location='{{ route('tutorInst.practicasAlumno.evidencias', $evidencia->id) }}'"><i
                                                class="fa fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $evidencias->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div style="text-align:center">No hay evidencias pendientes de validar.</div>
            @endif
        </div>
    </div>
</div>
@endsection