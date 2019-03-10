@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-8">
        <h2>Listado de instituciones</h2>
    </div>
    <div class="col-md-4">
        <button class="btn btn-success float-right" type="button" onclick="window.location='{{ route('instituciones.create') }}'"><i class="fas fa-plus-circle"></i> Nueva institución</button>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <br>

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped inline-table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fas fa-building"></i> Institución</th>
                                <th scope="col"><i class="fas fa-phone"></i> Teléfono</th>
                                <th scope="col"><i class="fas fa-user"></i> Responsable</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($instituciones as $inst)
                        <tr>
                            <td class="vertical-center" scope="row"> {{ $inst->denominacion }} </td>
                            <td class="vertical-center" scope="row"> {{ $inst->telefono }} </td>
                            <td class="vertical-center" scope="row"> @if(isset($inst->responsable)) {{ $inst->responsable->apellido1 }} {{ $inst->responsable->apellido2 }}, {{ $inst->responsable->name }} @endif</td>
                            <td class="vertical-center" scope="row">
                                <form method="POST" action='{{ route('instituciones.show', $inst->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('instituciones.show', $inst->id) }}'"><i
                                                class="fa fa-eye"></i></button>
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('instituciones.edit', $inst->id) }}'"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $instituciones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection