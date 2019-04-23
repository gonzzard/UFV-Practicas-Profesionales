@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Listado de tutores académicos</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" title="Nuevo tutor académico" type="button" onclick="window.location='{{ route('tutoresAcademicos.create') }}'"><i class="fas fa-plus-circle"></i> Nuevo tutor</button>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <br>
            @if(count($users) > 0)
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped inline-table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fas fa-user"></i> Nombre</th>
                                <th scope="col"><i class="fas fa-envelope"></i> Email</th>
                                <th scope="col"><i class="fas fa-id-card"></i> Documento</th>
                                <th scope="col"><i class="fas fa-unlock-alt"></i> Activo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tr>
                            <td class="vertical-center" scope="row">{{ $user->apellido1 }} {{ $user->apellido2 }}, {{ $user->name }}</td>
                            <td class="vertical-center" scope="row">{{ $user->email }}</td>
                            <td class="vertical-center" scope="row">{{ $user->docIdentificacion }}</td>
                            <td class="vertical-center" scope="row" style="text-align:center;">
                                    @if($user->activo == 1)
                                        <span class="text-success"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="text-danger"><i class="fas fa-times"></i></span>
                                    @endif
                                </td>
                            <td sclass="vertical-center" cope="row">
                                <form method="POST" action='{{ route('tutoresAcademicos.show', $user->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Ver tutor académico" onclick="window.location='{{ route('tutoresAcademicos.show', $user->id) }}'"><i
                                                class="fa fa-eye"></i></button>
                                        <button class="btn btn-info" type="button" title="Editar tutor académico" onclick="window.location='{{ route('tutoresAcademicos.edit', $user->id) }}'"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            @else
            <div style="text-align:center">No hay tutores académicos.</div>
            @endif
        </div>
    </div>
</div>
@endsection