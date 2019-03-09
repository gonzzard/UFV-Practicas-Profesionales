@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-dark" role="alert">
                Información del usuario {{ $user->first()->name }}
            </div>

            <div class="table-responsive">
                <table class="table table-inverted">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido 1</th>
                            <th>Apellido 2</th>
                            <th>Doc. identificación</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Descripción del Rol</th>
                            <th>Fecha de alta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->first()->name }}</td>
                            <td>{{ $user->first()->apellido1 }}</td>
                            <td>{{ $user->first()->apellido2 }}</td>
                            <td>{{ $user->first()->docIdentificacion }}</td>
                            <td>{{ $user->first()->email }}</td>
                            <td>{{ $user->first()->roles()->first()->nombre }}</td>
                            <td>{{ $user->first()->roles()->first()->descripcion }} </td>
                            <td>{{ $user->first()->created_at->format('d/m/Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection