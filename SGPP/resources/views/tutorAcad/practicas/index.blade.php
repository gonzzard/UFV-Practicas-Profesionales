@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Tutorizaciones curso: {{ $curso->denominacion}}</h2>
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
                                <th scope="col"><i class="fas fa-user"></i> Alumno</th>
                                <th scope="col"><i class="fas fa-chalkboard-teacher"></i> T. Acad</th>
                                <th scope="col"><i class="fas fa-building"></i> T. Inst</th>
                                <th scope="col" style="text-align:center;"><i class="fas fa-flag"></i> Estado</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($asignaciones as $asignacion)
                        <tr>
                            <td class="vertical-center" scope="row">{{ str_limit(($asignacion->alumno->apellido1 . " " . $asignacion->alumno->apellido2) , $limit
                                = 10, $end = '...') }}, {{ $asignacion->alumno->name}}</td>
                            <td class="vertical-center" scope="row">{{ str_limit(($asignacion->tutorAcad->apellido1 . " " . $asignacion->tutorAcad->apellido2) ,
                                $limit = 10, $end = '...') }}, {{ $asignacion->tutorAcad->name}}</td>
                            <td class="vertical-center" scope="row">{{ str_limit(($asignacion->tutorInst->apellido1 . " " . $asignacion->tutorInst->apellido2) ,
                                $limit = 10, $end = '...') }}, {{ $asignacion->tutorInst->name}}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">
                                @if($asignacion->estado->denominacion == "EN PROCESO")
                                <span class="badge badge-pill badge-info">{{$asignacion->estado->denominacion}}</span> @elseif($asignacion->estado->denominacion
                                == "TERMINADA")
                                <span class="badge badge-pill badge-success">{{$asignacion->estado->denominacion}}</span>                                @else
                                <span class="badge badge-pill badge-warning">{{$asignacion->estado->denominacion}}</span>                                @endif
                            </td>
                            <td class="vertical-center" scope="row">
                                <div class="btn-group btn-group-justified">
                                    <button class="btn btn-info" type="button" title="Ver asignación de prácticas" onclick="window.location='{{ route('tutorAcad.practicas.show', $asignacion->id) }}'"><i
                                        class="fa fa-eye"></i></button>
                                    <button class="btn btn-info" type="button" title="Porfolio de evidencias"  onclick="window.location='{{ route('tutorAcad.practicas.evidencias', $asignacion->id) }}'"><i
                                            class="fa fa-folder-open"></i></button>
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
            <div style="text-align:center">No hay asignaciones de prácticas.</div>
            @endif
        </div>
    </div>
</div>
@endsection