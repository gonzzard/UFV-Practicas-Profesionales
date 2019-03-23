@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Datos institución</h2>
    </div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4"></div>
        <div class="col-md-4">
                <label>Nombre</label>
                <input id="denominacion" type="text" class="form-control{{ $errors->has('denominacion') ? ' is-invalid' : '' }}" name="denominacion" value="{{ $institucion->denominacion }}"
                    required autofocus maxlength="255" disabled> @if ($errors->has('denominacion'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('denominacion') }}</strong>
                    </span> @endif
                <br>
                <label>Dirección</label>
                <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion"
                    value="{{ $institucion->direccion }}" required autofocus maxlength="255" disabled> @if ($errors->has('direccion'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('direccion') }}</strong>
                                </span> @endif
                <br>
                <label>Teléfono</label>
                <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono"
                    value="{{ $institucion->telefono }}" required autofocus maxlength="255" disabled> @if ($errors->has('telefono'))
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span> @endif
                <br>
                <label>Responsable</label>
                @if($institucion->responsable != null)
                    <select class="form-control m-bot15" name="responsable_id" disabled>
                            <option value="">Seleccione responsable</option>  
                            @foreach($responsables as $resp)
                                @if(isset($institucion->responsable) && $resp->id == $institucion->responsable->id)
                                    <option value="{{ $resp->id }}" selected>{{ $resp->apellido1 }} {{ $resp->apellido2 }}, {{ $resp->name }}</option>  
                                
                                    <option value="{{ $resp->id }}">{{ $resp->apellido1 }} {{ $resp->apellido2 }}, {{ $resp->name }}</option>  
                                @endif
                            @endforeach 
                    </select>
                @else
                <br>
                Sin responsable asignado.
                @endif
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection