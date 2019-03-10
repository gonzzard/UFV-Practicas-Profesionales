@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Listado de tutores académicos</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" type="button" onclick="window.location='{{ route('tutoresAcademicos.create') }}'"><i class="fas fa-plus-circle"></i> Nuevo tutor</button>
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
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tr>
                            <td scope="row"> {{ $user->apellido1 }} {{ $user->apellido2 }}, {{ $user->name }} </td>
                            <td scope="row"> {{ $user->email }} </td>
                            <td scope="row">
                                @foreach ($user->roles as $role) {{ $role->nombre }} <br> @endforeach
                            </td>
                            <td scope="row">
                                <form method="POST" action='{{ route('tutoresAcademicos.show', $user->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <div class="btn-group btn-group-justified">
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('tutoresAcademicos.show', $user->id) }}'"><i
                                                class="fa fa-eye"></i></button>
                                        <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('tutoresAcademicos.edit', $user->id) }}'"><i
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
        </div>
    </div>
</div>
@endsection