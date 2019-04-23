@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Nueva evidencia: {{$asignacion->practica->denominacion}}</h2>
    </div>
</div>

<hr>
<br>

<button type="button" onclick="window.location='{{ route('alumno.practicasAlumno.evidencias', $asignacion->id) }}'" class="btn btn-primary">
    <i class="fa fa-arrow-left"></i> Volver
</button>

<div class="container">
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
                    <label>Formato</label>
                    <select class="form-control" id="formato" name="formato" required>
                            <option value="Foto">Foto</option>
                            <option value="Documento">Documento</option>
                            <option value="Video">Vídeo</option>
                            <option value="Varios">Varios</option>
                          </select>
                    <br>
                    <label>URL evidencias</label>
                    <textarea maxlength="250" id="url" class="form-control" name="url" title="Dirección del repositorio con las evidencias" style="resize: none;"
                        rows="5" required></textarea>
                    <br>
                    <label>Observación</label>
                    <textarea maxlength="250" id="observacion" class="form-control" name="observacion" title="Observación" style="resize: none;"
                        rows="5" required></textarea>
                    <br>
                    <label>Horas</label>
                    <br>
                    <input id="horas" min="1" max="100" pattern="^\d*(\.\d{0,2})?$" step=".01" type="number" name="horas" class="form-control"
                        title="Horas realizadas" required style="width:100px;">
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