@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-9">
        <h2>Listado de titulaciones</h2>
    </div>
    <div class="col-md-3">
        <button class="btn btn-success float-right" type="button" onclick="window.location='{{ route('titulaciones.create') }}'"><i class="fas fa-plus-circle"></i> Nueva titulación</button>
    </div>
</div>

<hr>

<div class="container">
        <br>
    <div class="row">
        <div class="col-md-12">
            <div class="table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fa fa-user"></i> Nombre</th>
                            <th scope="col" style="text-align:center;"><i class="fa fa-certificate"></i> Grado</th>
                            <th scope="col" style="text-align:center;"><i class="fa fa-chalkboard-teacher"></i> Director</th>
                            <th scope="col" style="text-align:center;"><i class="fab fa-font-awesome-flag"></i> Mención</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    @foreach ($titulacion as $tit)
                    <tr>
                    <td class="vertical-center" scope="row" title="{{ $tit->denominacion }}"> {{ str_limit($tit->denominacion, $limit = 30, $end = '...') }}</td>

                        @if($tit->titulacionPrincipal != null)
                            <td class="vertical-center" scope="row" title="{{ $tit->titulacionPrincipal->denominacion }}" style="text-align:center;">
                                {{ str_limit($tit->titulacionPrincipal->denominacion , $limit = 30, $end = '...') }}
                            </td>
                        @else
                            <td class="vertical-center" scope="row" title="Sin titulación principal" style="text-align:center;">
                                <span class="text-success"><i class="fas fa-check"></i></span>
                            </td>
                        @endif

                        @if($tit->director != null)
                            <td class="vertical-center" scope="row" title="{{ $tit->director->apellido1 }} {{ $tit->director->apellido2 }}, {{ $tit->director->name }}" style="text-align:center;">
                                {{ str_limit(($tit->director->apellido1 . " " . $tit->director->apellido2), $limit = 15, $end = '...') }}, {{ $tit->director->name }}
                            </td>
                        @else
                            <td class="vertical-center" scope="row" title="Sin titulación principal" style="text-align: center;">
                                <span class="text-danger"><i class="fas fa-times"></i></span>
                            </td>
                        @endif
                        <td class="vertical-center" scope="row" style="text-align:center;">
                            @if($tit->mencion == 1)
                            <span class="text-success"><i class="fas fa-check"></i></span> @else
                            <span class="text-danger"><i class="fas fa-times"></i></span> @endif
                        </td>
                        <td class="vertical-center" scope="row">
                            <div class="row">
                                <form method="POST" action='{{ route('titulaciones.show', $tit->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('titulaciones.show', $tit->id) }}'"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('titulaciones.edit', $tit->id) }}'"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div style="text-align:center;">
        {{ $titulacion->links() }}
    </div>
</div>
@endsection