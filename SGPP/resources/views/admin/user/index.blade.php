@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row inline">
                <div class="col-8 align-self-center">
                    <h2>Listado de usuarios</h2>
                </div>
                <div class="col-4 align-self-center">
                    <button class="btn btn-success float-right" type="button"
                        onclick="window.location='{{ route('user.create') }}'">Nuevo usuario</button>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-inverted table-hover inline-table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center"><i class="far fa-user"></i> Nombre</th>
                                <th class="text-center"><i class="far fa-envelope"></i> Email</th>
                                <th class="text-center"><i class="fas fa-unlock-alt"></i> Rol</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tr>
                            <td class="align-middle"> {{ $user->name }} </td>
                            <td class="align-middle"> {{ $user->email }} </td>
                            <td class="align-middle">
                                @foreach ($user->roles as $role)
                                {{ $role->descripcion }} <br>
                                @endforeach
                            </td>
                            <td class="align-middle text-center">
                                <form method="POST" action='{{ route('user.show', $user->id) }}'
                                    onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info " type="button"
                                            onclick="window.location='{{ route('user.edit', $user->id) }}'"><i
                                                class="far fa-edit"></i> Editar</button>
                                        <button type="submit" class="btn btn-danger delete-user" value="Submit"><i
                                                class="far fa-window-close"></i> Eliminar usuario</button>
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