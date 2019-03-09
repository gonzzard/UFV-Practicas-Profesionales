@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nuevo curso académico</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form method="POST" action="{{ route('cursoacad.store') }}">
                @csrf
                <div class="form-group row">
                    <label>Denominación</label>
                    <input id="denominacion" type="text" class="form-control{{ $errors->has('denominacion') ? ' is-invalid' : '' }}" name="denominacion" 
                        value="{{ old('denominacion') }}" pattern="[0-9]{4}-[0-9]{2}" title="Formato válido ej: 2019-20" required>
                        @if ($errors->has('denominacion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('denominacion') }}</strong>
                    </span> @endif
                    <br><br>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="activo" name="activo" value="0">
                        <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection