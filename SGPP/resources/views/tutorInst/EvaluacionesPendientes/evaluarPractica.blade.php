@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Evaluar prácticas</h2>
    </div>
</div>

<hr>
<br>

<a href="{{ url('evaluacionesTutorInst') }}" class="btn btn-primary">
    <i class="fa fa-arrow-left"></i> Volver
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('tutorInst.evaluaciones.evaluacion', $asignacion->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label>Nota tutor institucional</label>
                        <input class="form-control" name="notaTutorInst"  id="notaTutorInst" type="number" min="1" max="10" style="text-align: center;">
                    </div>
                </div>
                <br>
                <label>Observación tutor institucional</label>
                <textarea id="observacionTutInst" class="form-control" name="observacionTutInst" title="Observación tutor institucional"
                    style="resize: none;" rows="5" required></textarea>
                <br>

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