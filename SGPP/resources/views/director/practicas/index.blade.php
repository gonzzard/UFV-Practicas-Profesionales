@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Listado de prácticas</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" title="Nueva práctica profesional" type="button" onclick="window.location='{{ route('practicas.create') }}'"><i class="fas fa-plus-circle"></i> Nueva práctica</button>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(count($practicas) > 0)
            <br>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped inline-table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fas fa-briefcase"></i> Práctica</th>
                                <th scope="col"><i class="fas fa-certificate"></i> Grado</th>
                                <th scope="col"><i class="fas fa-clock"></i> Horas totales</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($practicas as $practica)
                        <tr>
                            <td class="vertical-center" scope="row">{{ str_limit($practica->denominacion , $limit = 40, $end = '...') }}</td>
                            <td class="vertical-center" scope="row">{{ str_limit($practica->titulacion->denominacion , $limit = 40, $end = '...') }}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">{{ $practica->creditos * $practica->horasCredito }} </td>
                            <td class="vertical-center" scope="row">
                                <form method="POST" action='{{ route('practicas.show', $practica->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Ver práctica" onclick="window.location='{{ route('practicas.show', $practica->id) }}'"><i
                                                class="fas fa-eye"></i></button>
                                        <button @if(count($practica->asignaciones) > 0) disabled @endif class="btn btn-info" type="button" title="Editar práctica" onclick="window.location='{{ route('practicas.edit', $practica->id) }}'"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-info" type="button" title="Ver criterios de evaluación de prácticas" onclick="window.location='{{ route('criteriosEvaluacion.index', $practica->id) }}'"><i
                                                class="fas fa-tasks"></i></button>
                                        <button class="btn btn-info" type="button" title="Ver criterios encuesta valoración de institución" onclick="window.location='{{ route('criteriosEncuesta.index', $practica->id) }}'"><i
                                                class="fas fa-list"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $practicas->links() }}
                    </div>
                </div>
            </div>
            @else
            <div style="text-align:center">No hay prácticas creadas.</div>
            @endif
        </div>
    </div>
</div>
@endsection