@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Editar criterio evaluación: {{$criterio->practica->denominacion}}</h2>
    </div>
</div>

<hr>
<br>

<button type="button"  onclick="window.location='{{ route('criteriosEvaluacion.index', $criterio->practica->id) }}'" class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</button>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('criteriosEvaluacion.update', $criterio->id) }}">
                    @csrf {{ method_field('PATCH') }}
                <label>Denominación</label>
                <input type="text" class="form-control" value="{{ $criterio->practica->denominacion}}" disabled>
                <br>
                @if($criterio->practica->titulacion->titulacionPrincipal != null)
                    <label>Grado</label>
                    <input type="text" class="form-control"value="{{ $criterio->practica->titulacion->titulacionPrincipal->denominacion }}" disabled>
                    <br>
                    <label>Mención</label>
                    <input type="text" class="form-control"value="{{ $criterio->practica->titulacion->denominacion }}" disabled>
                    <br>
                @else 
                    <label>Grado</label>
                    <input type="text" class="form-control"value="{{ $criterio->practica->titulacion->denominacion  }}" disabled>
                    <br>
                    <label>Mención</label>
                    <input type="text" class="form-control"value="-" disabled>
                    <br>
                @endif
                <label>Criterio</label>
                <textarea id="criterio"type="text" class="form-control{{ $errors->has('criterio') ? ' is-invalid' : '' }}" name="criterio" value="{{ old('criterio') }}"
                    required autofocus maxlength="255" rows="5" style="resize: none;">{{$criterio->denominacion}}</textarea> @if ($errors->has('criterio'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('criterio') }}</strong>
                    </span> @endif
                    <br>
                    <label>Ponderación (Restante: {{$cantidadPonderadaRestante}}%)</label>
                    <input id="ponderacion" type="number" min="1" max="{{$ponderacionMax}}" class="form-control{{ $errors->has('ponderacion') ? ' is-invalid' : '' }}" name="ponderacion"
                        value="{{$criterio->ponderacion}}" required autofocus step="1" style="max-width: 100px; text-align: center"> 
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection