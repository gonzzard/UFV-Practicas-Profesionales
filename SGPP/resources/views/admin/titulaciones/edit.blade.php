@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        @if($titulacion->mencion == 1)
            <h2>Editar mención</h2>
        @else
            <h2>Editar titulación</h2> 
        @endif
    </div>
</div>

<hr>
<br>

<a href="{{ url('titulaciones') }}"class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('titulaciones.update', $titulacion->id) }}">
                    @csrf {{ method_field('PATCH') }}
                <div class="form-group row">
                    <label>Denominación</label>
                    <input  maxlength="255" id="denominacion" type="text" class="form-control" name="denominacion" value="{{ $titulacion->denominacion }}" required>
                    @if($titulacion->mencion == 1)
                        <br><br>
                        <label>Titulación principal</label>
                        <select class="form-control m-bot15" name="titulacion_principal_id">
                            <option value="">Ninguna</option>  
                            @foreach($tit_principales as $tit)
                                @if(isset($tit_principal) && $tit->id == $tit_principal->id)
                                    <option value="{{ $tit->id }}" selected>{{ $tit->denominacion }}</option>  
                                @else
                                    <option value="{{ $tit->id }}">{{ $tit->denominacion }}</option>  
                                @endif
                            @endforeach 
                        </select>
                    @endif
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection