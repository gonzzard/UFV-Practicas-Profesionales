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
    <div class="row justify-content-center">
        <div class="col-md-10">
            <br>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fa fa-certificate"></i> Nombre</th>
                                    <th scope="col" style="text-align:center;"><i class="fab fa-font-awesome-flag"></i> Mención</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach ($titulacion as $tit)
                            <tr>
                                <td class="vertical-center" scope="row"> {{ $tit->denominacion }}</td>
                                <td class="vertical-center" scope="row" style="text-align:center;">
                                    @if($tit->mencion == 1)
                                        <span class="text-success"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="text-danger"><i class="fas fa-times"></i></span>
                                    @endif
                                </td>
                                <td class="vertical-center" scope="row" style="display: inline;">
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
                <div class="col-sm-2">
                </div>
            </div>
        </div>
    </div>
    <div style="text-align:center;">
            {{ $titulacion->links() }}
    </div>
</div>
@endsection