@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Listado de directores</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" type="button" onclick="window.location='{{ route('directores.create') }}'"><i class="fas fa-plus-circle"></i> Nuevo director</button>
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
                    @if(count($directores) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-chalkboard-teacher"></i> Director</th>
                                    <th scope="col"><i class="fas fa-certificate"></i> Grado</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach ($directores as $director)
                            <tr>
                                <td class="vertical-center" scope="row">{{ $director->apellido1 }} {{ $director->apellido2 }}, {{ $director->name }}</td>
                                <td class="vertical-center" scope="row">{{ $director->titulacion->denominacion }}</td>
                                <td class="vertical-center" scope="row">
                                    <form method="POST" action='{{ route('directores.show', $director->titulacion->id) }}' onsubmit="return confirm('Confirmar eliminación del director');">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <div class="btn-group btn-group-justified">
                                            <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('directores.edit', $director->id) }}'"><i
                                                        class="fa fa-edit"></i></button>
                                            <button type="submit" class="btn btn-danger delete-user" title="Eliminar usuario" value="Submit"><i
                                                        class="fa fa-times"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $directores->links() }}
                        </div>
                    </div>
                    @else <div style="text-align:center">No hay directores de grado. </div>@endif
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection