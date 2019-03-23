@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nueva asignación curso</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('asignaciones.store') }}">
                @csrf
                <div class="form-group row">
                    <label>Práctica</label>
                    <select class="form-control m-bot15" name="practica_id" id="practica_id" required>
                        <option value="">Seleccione práctica</option>  
                        @foreach($practicas as $tit)
                            <option value="{{ $tit->id }}">{{ $tit->denominacion }}</option>  
                        @endforeach 
                    </select>
                    <br><br>
                    <label>Institución</label>
                    <select class="form-control m-bot15" name="institucion_id" id="institucion_id" disabled required>
                        <option value="">Seleccione institución</option>  
                    </select>
                    <br><br>
                    <label>Tutor Institucional</label>
                    <select class="form-control m-bot15" name="tinstitucional_id" id="tinstitucional_id" disabled required>
                        <option value="">Seleccione tutor institucional</option>  
                    </select>
                    <br><br>
                    <label>Tutor Académico</label>
                    <select class="form-control m-bot15" name="tacademico_id" id="tacademico_id" required>
                        <option value="">Seleccione tutor académico</option>
                        @foreach ($tutoresAcad as $tutorAcad)
                            <option value="{{$tutorAcad->id}}">{{$tutorAcad->apellido1}} {{$tutorAcad->apellido2}}, {{$tutorAcad->name}}</option>    
                        @endforeach
                    </select>
                    <br><br>
                    <label>Alumno</label>
                    <select class="form-control m-bot15" name="alumno_id" id="alumno_id" disabled required>
                        <option value="">Seleccione alumno</option>  
                    </select>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection