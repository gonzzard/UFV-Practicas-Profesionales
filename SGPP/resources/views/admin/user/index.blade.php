@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Listado de usuarios</h2>
    </div>
    <div class="col-md-6">
        <div style="float: right">
            <button class="btn btn-success" type="button" onclick="window.location='{{ route('admin.user.cargaExcel') }}'" title="Carga de usuarios"><i class="fas fa-plus-circle"></i> Carga de usuarios</button>
            <button class="btn btn-success" type="button" onclick="window.location='{{ route('user.create') }}'" title="Nuevo usuario"><i class="fas fa-plus-circle"></i> Nuevo usuario</button>
        </div>
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
                                <th scope="col"><i class="fas fa-user"></i> Nombre</th>
                                <th scope="col"><i class="fas fa-envelope"></i> Email</th>
                                <th scope="col"><i class="fas fa-unlock-alt"></i> Rol</th>
                                <th scope="col"><i class="fas fa-unlock-alt"></i> Activo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tr>
                            <td class="vertical-center" scope="row"> @if($user->apellido1 != "") {{ $user->apellido1 }} @endif @if($user->apellido2 != "") {{ $user->apellido2
                                }}, @endif {{ $user->name }}</td>
                            <td class="vertical-center" scope="row"> {{ $user->email }} </td>
                            <td class="vertical-center" scope="row">
                                @foreach ($user->roles as $role) {{ $role->nombre }} <br> @endforeach
                            </td>
                            <td class="vertical-center" scope="row" style="text-align:center;">
                                @if($user->activo == 1)
                                <span class="text-success"><i class="fas fa-check"></i></span> @else
                                <span class="text-danger"><i class="fas fa-times"></i></span> @endif
                            </td>
                            <td class="vertical-center" scope="row">
                                <form method="POST" action='{{ route('user.show', $user->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Ver usuario" onclick="window.location='{{ route('user.show', $user->id) }}'"><i
                                                class="fa fa-eye"></i></button>
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('user.edit', $user->id) }}'"><i
                                                class="fa fa-edit"></i></button>
                                        <!--<button type="submit" class="btn btn-danger delete-user" title="Eliminar usuario" value="Submit"><i
                                                class="fa fa-times"></i></button> -->
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
        </div>
    </div>
</div>
@endsection