@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Validar evidencia</h2>
    </div>
</div>

<hr>
<br>

<a href="{{ url('evidenciasPorValidar') }}"class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('tutorInst.practicasAlumno.evidencias', $evidencia->id) }}">
                @csrf
                <div class="form-group row">
                    <input id="asignacion_id" type="hidden" name="asignacion_id" value="{{$evidencia->id}}">
                    <label>Alumno</label>
                    <input id="alumno" type="text" class="form-control" name="alumno" title="Alumno en prácticas" value="{{$evidencia->asignacion->alumno->apellido1}} {{$evidencia->asignacion->alumno->apellido2}}, {{$evidencia->asignacion->alumno->name}}" required disabled>
                    <br><br>
                    <label>Tutor Académico</label>
                    <input id="tutorAcad" type="text" class="form-control" name="tutorAcad" title="Tutor académico" value="{{$evidencia->asignacion->tutorAcad->apellido1}} {{$evidencia->asignacion->tutorAcad->apellido2}}, {{$evidencia->asignacion->tutorAcad->name}}" required disabled>
                    <br><br>
                    <label>Tutor Institucional</label>
                    <input id="tutorInst" type="text" class="form-control" name="tutorInst" title="Tutor Institucional" value="{{$evidencia->asignacion->tutorInst->apellido1}} {{$evidencia->asignacion->tutorInst->apellido2}}, {{$evidencia->asignacion->tutorInst->name}}" required disabled>
                    <br><br>
                    <label>Institución</label>
                    <input id="Inst" type="text" class="form-control" name="Inst" title="Institución" value="{{$evidencia->asignacion->tutorInst->institucion->denominacion}}" required disabled>
                    <br><br>
                    <label>Actividad</label>
                    <input id="actividad" type="text" class="form-control" name="actividad" title="Actividad" value="{{$evidencia->actividad}}" required disabled>
                    <br><br>
                    <label>URL evidencias</label>
                    <textarea id="url" class="form-control" name="url" title="URL evidencias" style="resize: none;" rows="5" required disabled>{{$evidencia->urlEvidencias}}</textarea>
                    <br><br>
                    <label>Horas</label>
                    <input id="horas" type="number" name="horas" class="form-control" title="Formato válido ej: 2019-20" value="{{$evidencia->horasRealizadas}}" required disabled>
                    <br><br>
                    <label>Observación</label>
                    <textarea id="observacion" class="form-control" name="observacion" title="URL evidencias" style="resize: none;" rows="5" required disabled>{{$evidencia->observacion}}</textarea>
                    <br>
                    <div class="custom-control custom-switch">
                        <br>
                        <input type="checkbox" class="custom-control-input" id="validar" name="validar">
                        <label class="custom-control-label" for="validar">Validar evidencia</label>
                    </div>
                </div>
                <div class="form-group" style="text-align:center">
                    <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection