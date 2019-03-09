@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-9">
        <h2>Titulación: {{ $titulacion->denominacion }}</h2>
    </div>
    <div class="col-md-3"></div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <label>Denominación</label>
            <input id="denominacion" type="text" class="form-control" name="denominacion" value=" {{ $titulacion->denominacion }}" required
                disabled>
            <br>
            @if(isset($menciones) && count($menciones) > 0)
            <label>Menciones</label>
            <div class="table-responsive">
                <table class="table table-striped inline-table">
                    <thead>
                    </thead>
                    @foreach ($menciones as $tit)
                    <tr>
                        <td scope="row"> {{ $tit->denominacion }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <label>Titulación principal</label>
            <input id="titulacion_principal" type="text" class="form-control" name="titulacion_principal" value=" {{ $titulacion_principal->denominacion }}" required disabled>
            @endif
        </div>
    </div>
</div>
@endsection