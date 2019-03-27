@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Evidencia: {{$evidencia->asignacion->practica->denominacion}}</h2>
    </div>
</div>

<hr>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>Actividad</label>
                <input id="actividad" value="{{$evidencia->actividad}}" type="text" class="form-control" name="actividad" title="Actividad realizada" maxlength="140" required disabled>
                <br>
                <label>URL evidencias</label>
                <textarea id="url" class="form-control" name="url" title="Dirección del repositorio con las evidencias" style="resize: none;"
                    rows="5" required disabled>{{$evidencia->urlEvidencias}}</textarea>
                <br>
                <label>Observación</label>
                <textarea id="observacion" class="form-control" name="observacion" title="Observación" style="resize: none;" rows="5" required disabled>{{$evidencia->observacion}}</textarea>
                <br>
                <label>Horas</label>
                <br>
                <input id="horas" value="{{$evidencia->horasRealizadas}}" type="number" name="horas" class="form-control" title="Horas realizadas" required style="width:100px;" disabled>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
@endsection