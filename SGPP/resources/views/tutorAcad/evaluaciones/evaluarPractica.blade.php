@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Valoración de institución: {{$asignacion->tutorInst->institucion->denominacion}}</h2>
    </div>
</div>

<hr>

<br>

<div class="container">
    <form method="POST" action="{{ route('tutorAcad.evaluaciones.evaluarPracticaStore', $asignacion->id) }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-10">
                <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-certificate"></i> Pregunta</th>
                                    <th scope="col" style="text-align:right;"><i class="fas fa-building"></i> Valoración</th>
                                </tr>
                            </thead>
                            <?php $i = 0; ?> @foreach ($practica->criterios as $criterio)
                            <?php 
                                    $key = array_search($criterio->id, array_column($asignacion->evaluacions->ToArray(), 'id')); 
                                    if($key != false)
                                    {
                                        $notaTemp = $asignacion->evaluacions->ToArray()[$key]["nota"];
                                    }
                                ?>
                            <tr>
                                <input type="hidden" id="criterio[{{$i}}][id]" name="criterio[{{$i}}][id]" value="{{$criterio->id}}">
                                <td class="vertical-center" scope="row">
                                    {{ $criterio->denominacion}}
                                </td>
                                <td class="vertical-center" scope="row"  style="float:right;">
                                    <input id="criterio[{{$i}}][valor]" type="number" min="1" max="10" step="0.1" pattern="^\d*(\.\d{0,2})?$" name="criterio[{{$i}}][valor]" @if(isset($notaTemp)) value="{{  $notaTemp }}" @endif class="form-control"
                                        required style="width: 100px; text-align:center" @if(isset($notaTemp)) disabled @endif></td>
                            </tr>
                            <?php $i += 1 ?> @endforeach
                        </table>
                    </div>
                </div>
                @if(!isset($notaTemp))
                
                <div class="form-group" style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar
                            </button>
                    </div>
                @endif

            </div>
        </div>
    </form>
</div>
@endsection