@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Listado de cursos académicos</h2>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success float-right" type="button" onclick="window.location='{{ route('cursoacad.create') }}'"><i class="fas fa-plus-circle"></i> Nuevo curso</button>
    </div>
</div>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <br>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="table-responsive">
                        <table class="table table-striped inline-table">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;"><i class="fa fa-calendar"></i> Curso</th>
                                    <th scope="col" style="text-align:center;"><i class="fab fa-font-awesome-flag"></i> Activo</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach ($cursosacad as $curso)
                            <tr>
                                <td class="vertical-center" scope="row" style="text-align:center;"> {{ $curso->denominacion }}</td>
                                <td class="vertical-center" scope="row" style="text-align:center;">
                                    @if($curso->activo == 1)
                                        <span class="text-success"><i class="fas fa-check"></i></span>
                                    @else
                                        <span class="text-danger"><i class="fas fa-times"></i></span>
                                    @endif
                                </td>
                                <td class="vertical-center" scope="row" style="text-align:center;">
                                    <form method="POST" action='{{ route('cursoacad.show', $curso->id) }}' onsubmit="return confirm('Confirmar eliminación del usuario');">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <div class="btn-group btn-group-justified">
                                            <button class="btn btn-info" type="button" title="Editar usuario" onclick="window.location='{{ route('cursoacad.edit', $curso->id) }}'"><i
                                                class="fa fa-edit"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $cursosacad->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection