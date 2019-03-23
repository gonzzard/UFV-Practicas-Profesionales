@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Criterios evaluación: {{ str_limit($practica->denominacion, $limit = 35, $end = '...') }}</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" title="Nuevo criterio de evaluación de prácticas" type="button" onclick="window.location='{{ route('criteriosEvaluacion.create', $practica->id) }}'"><i class="fas fa-plus-circle"></i> Nuevo criterio</button>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($criterios) > 0)
            <br>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped inline-table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fas fa-align-justify"></i> Denominación</th>
                                <th scope="col"><i class="fas fa-percentage"></i> Ponderación</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($criterios as $criterio)
                        <tr>
                            <td class="vertical-center" scope="row">{{ str_limit($criterio->denominacion , $limit = 40, $end = '...') }}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">{{ $criterio->ponderacion }} </td>
                            <td class="vertical-center" scope="row">
                                <div class="btn-group btn-group-justified">
                                    <button class="btn btn-info" type="button" title="Ver criterio de evaluación de prácticas" onclick="window.location='{{ route('criteriosEvaluacion.show', $criterio->id) }}'"><i
                                                    class="fas fa-eye"></i></button>
                                    <button class="btn btn-info" type="button" title="Editar criterio de evaluación de prácticas" onclick="window.location='{{ route('criteriosEvaluacion.edit', $criterio->id) }}'"><i
                                                    class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $criterios->links() }}
                    </div>
                </div>
            </div>
            @else
            <div style="text-align:center">No hay criterios creados.</div>
            @endif
        </div>
    </div>
</div>
@endsection