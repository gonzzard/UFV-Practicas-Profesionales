@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Porfolio: {{$asignacion->practica->denominacion}}</h2>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                @if(count($evidencias) > 0)
            <br>

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped inline-table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fas fa-align-justify"></i> Actividad</th>
                                <th scope="col"><i class="fas fa-clock"></i> Horas</th>
                                <th scope="col"><i class="fas fa-thumbs-up"></i> Validado</th>
                                <th scope="col"><i class="fas fa-check-double"></i> Comprobado</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($evidencias as $evidencia)
                        <tr>
                            <td class="vertical-center" scope="row">{{ str_limit($evidencia->actividad, $limit = 55, $end = '...') }}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">{{ $evidencia->horasRealizadas}}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">
                                @if($evidencia->validado == 1)
                                    <span class="text-success"><i class="fas fa-check"></i></span>
                                @else
                                    <span class="text-danger"><i class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td class="vertical-center" scope="row" style="text-align:center;">
                                @if($evidencia->comprobado == 1)
                                    <span class="text-success"><i class="fas fa-check"></i></span>
                                @else
                                    <span class="text-danger"><i class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td class="vertical-center" scope="row">
                                <div class="btn-group btn-group-justified">
                                    <button class="btn btn-info" type="button" title="Evidencias" onclick="window.location='{{ route('tutorAcad.practicas.evidencia', $evidencia->id) }}'"><i
                                            class="fa fa-eye"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $evidencias->links() }}
                    </div>
                </div>
            </div>
            @else
            <div style="text-align:center">El porfolio esta vacío.</div>
            @endif
        </div>
    </div>
</div>
@endsection