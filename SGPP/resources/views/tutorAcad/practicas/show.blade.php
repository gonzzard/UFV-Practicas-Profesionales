@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Asignación curso: {{ $asignacion->practica->cursoacad->denominacion}}</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>
<br>

<a href="{{ url('tutorAcad/practicasTutorizadas') }}"class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</a>

<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <h4>
                        @if($asignacion->estado->denominacion == "EN PROCESO")
                        <span class="badge badge-pill badge-info">{{$asignacion->estado->denominacion}}</span> @elseif($asignacion->estado->denominacion
                        == "TERMINADA")
                        <span class="badge badge-pill badge-success">{{$asignacion->estado->denominacion}}</span> @else
                        <span class="badge badge-pill badge-warning">{{$asignacion->estado->denominacion}}</span> @endif</h2>
                </div>
            </div>
            <br>
            <label>Práctica</label>
            <select class="form-control m-bot15" disabled>
                        <option value="{{ $asignacion->practica->id }}">{{ $asignacion->practica->denominacion }}</option>  
                    </select>
            <br>
            <label>Institución</label>
            <select class="form-control m-bot15" disabled>
                    <option value="{{ $asignacion->tutorInst->institucion->id }}">{{ $asignacion->tutorInst->institucion->denominacion }}</option>  
                </select>
            <br>
            <label>Tutor Institucional</label>
            <select class="form-control m-bot15" disabled>
                    <option value="{{ $asignacion->tutorInst->id }}">{{ $asignacion->tutorInst->apellido2 }} {{ $asignacion->tutorInst->apellido1 }}, {{ $asignacion->tutorInst->name }}</option>  
                </select>
            <br>
            <label>Tutor Académico</label>
            <select class="form-control m-bot15" disabled>
                    <option value="{{ $asignacion->tutorAcad->id }}">{{ $asignacion->tutorAcad->apellido2 }} {{ $asignacion->tutorAcad->apellido1 }}, {{ $asignacion->tutorAcad->name }}</option>  
                </select>
            <br>
            <label>Alumno</label>
            <select class="form-control m-bot15" disabled>
                    <option value="{{ $asignacion->alumno->id }}">{{ $asignacion->alumno->apellido2 }} {{ $asignacion->alumno->apellido1 }}, {{ $asignacion->alumno->name }}</option>  
                </select>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label>Horas realizadas</label>
                    <input class="form-control" type="text" value="{{ $asignacion->horasRealizadas}}" disabled style="text-align: center;">
                </div>
                <div class="col-md-4">
                    <label>Horas totales</label>
                    <input class="form-control" type="text" value="{{ $asignacion->practica->horasTotales }}" disabled style="text-align: center;">
                </div>
                <div class="col-md-4">
                    <label>Horas totales</label>
                    <input class="form-control" type="text" value="{{ $asignacion->practica->horasTotales }}" disabled style="text-align: center;">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group btn-group-justified" style="min-width: 100%" >
                        <button class="btn btn-info" type="button" title="Ver evaluación de prácticas" onclick="window.location='{{ route('tutorAcad.practicas.valoracionPracticas', $asignacion->id) }}'" @if($asignacion->notaFinal == -1) disabled @endif><i
                            class="fa fa-list"></i> Evaluación de la práctica</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>
@endsection