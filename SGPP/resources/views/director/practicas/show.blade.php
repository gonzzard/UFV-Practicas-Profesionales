@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Editar práctica curso {{$practica->cursoacad->denominacion}}</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
                <div class="form-group row">
                    <label>Titulación</label>
                    <select class="form-control m-bot15" name="titulacion_id" required disabled>
                            @if($practica->titulacion->titulacionPrincipal == null)
                                <option title="{{$practica->titulacion->denominacion}}" value="{{$practica->titulacion->id }}">{{ str_limit($practica->titulacion->denominacion, $limit = 70, $end = '...') }}</option>  
                            @else
                                <option title="{{$practica->titulacion->denominacion}}" value="{{$practica->titulacion->id }}"> {{ str_limit($practica->titulacion->denominacion, $limit = 40, $end = '...') }} ({{ $practica->titulacion->titulacionPrincipal->denominacion }})</option>  
                            @endif
                    </select>
                    <br><br>
                    <label>Nombre prácticas</label>
                    <input type="text" id="denominacion" class="form-control" name="denominacion" title="Nombre Prácticas" required value="{{$practica->denominacion}}" disabled>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Créditos</label>
                            <input type="number" value="{{$practica->creditos}}" id="creditos" class="form-control" name="creditos" title="Créditos de la práctica" required disabled>
                        </div>
                        <div class="col-md-4">
                            <label>Horas/Crédito</label>
                            <input type="number" value="{{$practica->horasCredito}}" id="horasCredito" class="form-control" name="horasCredito" title="Créditos/Hora" required disabled>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection