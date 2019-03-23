@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Mis prácticas curso {{$curso->denominacion }}</h2>
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
                                    <th scope="col"><i class="fas fa-certificate"></i> Grado</th>
                                    <th scope="col"><i class="fas fa-building"></i> Institución</th>
                                    <th scope="col"><i class="fas fa-clock"></i> Horas</th>
                                    <th scope="col"><i class="fas fa-clock"></i> Horas realizadas</th>
                                    <th scope="col"><i class="fas fa-flag"></i> Estado</th>
                                    <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($asignaciones as $asignacion)
                        <tr>
                            <td class="vertical-center" scope="row">{{str_limit($asignacion->practica->titulacion->denominacion, $limit = 30, $end = '...') }}</td>
                            <td class="vertical-center" scope="row">{{ $asignacion->tutorInst->institucion->denominacion}}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">{{ $asignacion->practica->horasTotales }}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">{{ $asignacion->horasRealizadas}}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">
                                    @if($asignacion->estado->denominacion == "EN PROCESO")
                                        <span class="badge badge-pill badge-info">{{$asignacion->estado->denominacion}}</span>
                                    @elseif($asignacion->estado->denominacion == "TERMINADA")
                                        <span class="badge badge-pill badge-success">{{$asignacion->estado->denominacion}}</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">{{$asignacion->estado->denominacion}}</span>
                                    @endif
                                </td>
                            <td class="vertical-center" scope="row">
                                <div class="btn-group btn-group-justified">
                                    <button class="btn btn-info" type="button" title="Porfolio de evidencias" onclick="window.location='{{ route('alumno.practicasAlumno.evidencias', $asignacion->id) }}'"><i
                                            class="fa fa-folder-open"></i></button>
                                    <button class="btn btn-info" type="button" title="Valorar intitución" onclick="window.location='{{ route('alumno.practicasAlumno.valorarInstitucion', $asignacion->id) }}'" @if($asignacion->estado->denominacion == "EN PROCESO") disabled @endif><i
                                            class="fa fa-sign-out-alt"></i></button>
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
            <div style="text-align:center">No tienes prácticas profesionales.</div>
            @endif
        </div>
    </div>
</div>
@endsection