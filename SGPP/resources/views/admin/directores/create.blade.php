@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nuevo director</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form method="POST" action="{{ route('directores.store') }}">
                @csrf
                <div class="form-group row">
                    <label>Director</label>
                    <select class="form-control m-bot15" name="profesor_id" required>
                        <option value="">Seleccione director</option>  
                        @foreach($usuarios as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->apellido1 }} {{ $prof->apellido2 }}, {{ $prof->name }}</option>  
                        @endforeach 
                    </select>
                    <br><br>
                    <label>Titulación</label>
                    <select class="form-control m-bot15" name="titulacion_id" required>
                        <option value="">Seleccione titulación</option>  
                        @foreach($titulaciones as $tit)
                            <option value="{{ $tit->id }}">{{ $tit->denominacion }}</option>  
                        @endforeach 
                    </select>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection