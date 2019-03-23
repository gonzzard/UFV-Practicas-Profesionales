@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Editar director</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
        <br>
    <div class="row justify-content-center">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form method="POST" action="{{ route('directores.update', $directorSeleccionado->id) }}">
                @csrf {{ method_field('PATCH') }}
                <div class="form-group row">
                <input type="hidden" id="tit_anterior" name="tit_anterior" value="{{$titulacionSeleccionada->id}}">
                    <label>Director</label>
                    <input id="director" type="text" class="form-control" name="director" value="{{ $directorSeleccionado->apellido1 }} {{ $directorSeleccionado->apellido2 }}, {{ $directorSeleccionado->name }}" required disabled> 
                    <br><br>
                    <label>Titulación</label>
                    <select class="form-control m-bot15" name="titulacion_id" required>
                        <option value="">Seleccione titulación</option>  
                        @foreach($titulaciones as $tit)
                            <option value="{{ $tit->id }}" {{ $titulacionSeleccionada->id == $tit->id ? 'selected="selected"' : '' }}>{{ $tit->denominacion }}</option>  
                        @endforeach 
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
        <div class="col-md-4">
        </div>
    </div>
@endsection