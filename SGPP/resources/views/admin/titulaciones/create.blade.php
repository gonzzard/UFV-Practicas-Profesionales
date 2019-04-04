@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nueva titulacion</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>
<br>

<a href="{{ url('titulaciones') }}"class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form method="POST" action="{{ route('titulaciones.store') }}">
                @csrf
                <div class="form-group row">
                    <label>Denominación</label>
                    <input  maxlength="255" id="denominacion" type="text" class="form-control" name="denominacion" value="" required>
                    <br><br>
                    <label>Titulación principal</label>
                    <select class="form-control m-bot15" name="titulacion_principal_id">
                        <option value="">Ninguna</option>  
                        @foreach($titulaciones as $tit)
                            <option value="{{ $tit->id }}">{{ $tit->denominacion }}</option>  
                        @endforeach 
                    </select>
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
        <div class="col-md-4">
        </div>
    </div>
@endsection