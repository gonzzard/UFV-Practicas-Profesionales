@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Editar tutor institucional</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('tutoresInstitucionales.update', $user->id) }}">
                @csrf {{ method_field('PATCH') }}

                <div class="form-group row">
                    <label for="docIdentificacion" class="col-md-4 col-form-label text-md-right">Documento de identificación</label>

                    <div class="col-md-6">
                        <input id="docIdentificacion" type="text" class="form-control{{ $errors->has('docIdentificacion') ? ' is-invalid' : '' }}"
                        title="Solo son válidos DNIs sin letra" pattern="[0-9]{8}" name="docIdentificacion" value="{{ $user->docIdentificacion }}" onblur="validaNif(this)" required
                            autofocus maxlength="255"> @if ($errors->has('docIdentificacion'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docIdentificacion') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}"
                            required autofocus maxlength="255"> @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-md-4 col-form-label text-md-right">Apellido 1</label>

                    <div class="col-md-6">
                        <input id="apellido1" type="text" class="form-control{{ $errors->has('apellido1') ? ' is-invalid' : '' }}" name="apellido1"
                            value="{{ $user->apellido1 }}" required autofocus maxlength="255"> @if ($errors->has('apellido1'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellido1') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido2" class="col-md-4 col-form-label text-md-right">Apellido 2</label>

                    <div class="col-md-6">
                        <input id="apellido2" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2"
                            value="{{ $user->apellido2 }}" required autofocus maxlength="255"> @if ($errors->has('apellido2'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellido2') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required maxlength="255"> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Institución</label>
                    <div class="col-md-6">
                        <select class="form-control m-bot15" name="institucion_id" required disabled>
                        <option value="">Seleccione titulación</option>  
                        @foreach($instituciones as $inst)
                            @if($inst->id == $user->institucion->id)
                                <option value="{{ $inst->id }}" selected>{{ $inst->denominacion }}</option>  
                            @else
                                <option value="{{ $inst->id }}">{{ $inst->denominacion }}</option>  
                            @endif
                        @endforeach 
                    </select>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4" style="text-align:center;">
                        <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection