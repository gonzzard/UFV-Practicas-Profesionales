@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nueva práctica curso {{$curso->denominacion}}</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('practicas.store') }}">
                @csrf
                <div class="form-group row">
                    <label>Titulación</label>
                    <select class="form-control m-bot15" name="titulacion_id" required>
                        <option value="">Seleccione titulación</option>  
                        @foreach($titulaciones as $tit)
                            @if($tit->titulacionPrincipal == null)
                                <option title="{{$tit->denominacion}}" value="{{ $tit->id }}">{{ str_limit($tit->denominacion, $limit = 70, $end = '...') }}</option>  
                            @else
                                <option title="{{$tit->denominacion}}" value="{{ $tit->id }}"> {{ str_limit($tit->denominacion, $limit = 40, $end = '...') }} ({{ $tit->titulacionPrincipal->denominacion }})</option>  
                            @endif
                        @endforeach 
                    </select>
                    <br><br>
                    <label>Nombre prácticas</label>
                    <input type="text" id="denominacion" class="form-control" name="denominacion" title="Nombre Prácticas" maxlength="255" required>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Créditos</label>
                            <input type="number" min="1" id="creditos" class="form-control" name="creditos" title="Créditos de la práctica" required>
                        </div>
                        <div class="col-md-4">
                            <label>Horas/Crédito</label>
                            <input type="number" min="1" id="horasCredito" class="form-control" name="horasCredito" title="Horas/Crédito<" required>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
                <div style="text-align:center;">
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