@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Nueva evidencia: {{$asignacion->practica->denominacion}}</h2>
    </div>
</div>

<hr>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <form method="POST" action="{{ route('alumno.practicasAlumno.store') }}">
                @csrf
                <div class="form-group">
                    <label>Actividad (Máx. 140 caracteres)</label>
                    <input id="asignacion_id" type="hidden" name="asignacion_id" value="{{$asignacion->id}}">
                    <input id="actividad" type="text" class="form-control" name="actividad" title="Actividad realizada" maxlength="140" required>
                    <br>
                    <label>URL evidencias</label>
                    <textarea id="url" class="form-control" name="url" title="Dirección del repositorio con las evidencias" style="resize: none;" rows="5" required></textarea>
                    <br>
                    <label>Observación</label>
                    <textarea id="observacion" class="form-control" name="observacion" title="Observación" style="resize: none;" rows="5" required></textarea>
                    <br>
                    <label>Horas</label>
                    <br>
                    <input id="horas" type="number" name="horas" class="form-control" title="Horas realizadas" required style="width:100px;">
                    <br>
                </div>
                <div class="form-group" style="text-align:center">
                    <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
        </div>
    </div>
@endsection