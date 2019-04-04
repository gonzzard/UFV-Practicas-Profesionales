@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Listado de directores</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" type="button" onclick="window.location='{{ route('directores.create') }}'" title="Nuevo director"><i class="fas fa-plus-circle"></i> Nuevo director</button>
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
                    @if(count($grados) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-chalkboard-teacher"></i> Director</th>
                                    <th scope="col"><i class="fas fa-certificate"></i> Grado</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach ($grados as $grado)
                            <tr>
                                <td class="vertical-center" scope="row">{{ $grado->director->apellido1 }} {{ $grado->director->apellido2 }}, {{ $grado->director->name }}</td>
                                <td class="vertical-center" scope="row">{{ $grado->director->titulacion->denominacion }}</td>
                                <td class="vertical-center" scope="row">
                                    <form method="POST" action='{{ route('directores.show', $grado->director->titulacion->id) }}' onsubmit="return confirm('Confirmar eliminación del director');">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <input type="hidden" value="{{ $grado->id }}" id="tit_anterior" name="tit_anterior">
                                        <div class="btn-group btn-group-justified">
                                            <button class="btn btn-info" type="button" title="Editar director" onclick="window.location='{{ route('directores.edit', $grado->director->id) }}'"><i
                                                        class="fa fa-edit"></i></button>
                                            <button type="submit" class="btn btn-danger delete-user" title="Eliminar director" value="Submit"><i
                                                        class="fa fa-times"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $grados->links() }}
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