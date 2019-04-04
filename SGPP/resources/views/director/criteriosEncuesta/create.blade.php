@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Nuevo criterio evaluación institución {{$practica->criterio}}</h2>
    </div>
</div>

<hr>
<br>

<button type="button"  onclick="window.location='{{ route('criteriosEncuesta.index', $practica->id) }}'" class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</button>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('criteriosEncuesta.store') }}">
                @csrf
                <label>Denominación</label>
                <input type="text" class="form-control" value="{{ $practica->denominacion}}" disabled>
                <input type="hidden" id="practica_id" name="practica_id" value="{{$practica->id}}">
                <br>
                @if($practica->titulacion->titulacionPrincipal != null)
                    <label>Grado</label>
                    <input type="text" class="form-control"value="{{ $practica->titulacion->titulacionPrincipal->denominacion }}" disabled>
                    <br>
                    <label>Mención</label>
                    <input type="text" class="form-control"value="{{ $practica->titulacion->denominacion }}" disabled>
                    <br>
                @else 
                    <label>Grado</label>
                    <input type="text" class="form-control"value="{{ $practica->titulacion->denominacion  }}" disabled>
                    <br>
                    <label>Mención</label>
                    <input type="text" class="form-control"value="-" disabled>
                    <br>
                @endif
                <label>Criterio</label>
                <textarea id="criterio" type="text" class="form-control{{ $errors->has('criterio') ? ' is-invalid' : '' }}" name="criterio" value="{{ old('criterio') }}"
                    required autofocus maxlength="255" rows="5" style="resize: none;"></textarea> @if ($errors->has('criterio'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('criterio') }}</strong>
                    </span> @endif
                <br>
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