@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Valoración de institución: {{$asignacion->tutorInst->institucion->denominacion}}</h2>
    </div>
</div>

<hr>
<br>

<button type="button"  onclick="window.location='{{ route('director.asignaciones.show', $asignacion->id) }}'" class="btn btn-primary" >
    <i class="fa fa-arrow-left"></i> Volver
</button>

<div class="container">
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
                            <?php $i = 0; ?> @foreach ($practica->criterioEncuestaPracticas as $criterio)
                            <?php 
                                if(count($asignacion->encuestaPracticas) > 0)
                                {
                                    $notaTemp = $asignacion->encuestaPracticas->ToArray()[$i]["nota"];
                                }
                                ?>
                            <tr>
                                <input type="hidden" id="criterio[{{$i}}][id]" name="criterio[{{$i}}][id]" value="{{$criterio->id}}">
                                <td class="vertical-center" scope="row">
                                    {{ $criterio->denominacion}}
                                </td>
                                <td class="vertical-center" scope="row" style="float:right;">
                               
                                    <input id="criterio[{{$i}}][valor]" type="number" min="1" max="10" name="criterio[{{$i}}][valor]" @if(isset($notaTemp)) value="{{$notaTemp}}" @endif class="form-control"
                                        required style="width: 100px; text-align:center" disabled></td>
                            </tr>
                            <?php $i += 1 ?> @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection