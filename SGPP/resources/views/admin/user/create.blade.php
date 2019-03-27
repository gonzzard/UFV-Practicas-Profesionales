@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nuevo usuario</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<br>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="docIdentificacion" class="col-md-4 col-form-label text-md-right">Documento de identificación</label>

                    <div class="col-md-6">
                        <input id="docIdentificacion" type="text" class="form-control{{ $errors->has('docIdentificacion') ? ' is-invalid' : '' }}"
                            title="Solo son válidos DNIs sin letra" pattern="[0-9]{8}" name="docIdentificacion" value="{{ old('docIdentificacion') }}" onblur="validaNif(this)"
                            required title="El documento costa de 8 caracteres numéricos." autofocus maxlength="255">                        @if ($errors->has('docIdentificacion'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docIdentificacion') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
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
                            value="{{ old('apellido1') }}" required autofocus maxlength="255"> @if ($errors->has('apellido1'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellido1') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido2" class="col-md-4 col-form-label text-md-right">Apellido 2</label>

                    <div class="col-md-6">
                        <input id="apellido2" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2"
                            value="{{ old('apellido2') }}" required autofocus maxlength="255"> @if ($errors->has('apellido2'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellido2') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required maxlength="255">                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required maxlength="15"> @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">Rol</label>
                    <div class="col-md-6">
                        @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="role[]" value="{{ $role['id'] }}">
                            <label class="form-check-label" for="role[]">{{ $role['nombre'] }}</label><br>
                        </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="form-group" style="text-align:center;">
                    <button type="submit" class="btn btn-primary" id="checkBtn" name="checkBtn">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        $('#checkBtn').click(function() {
          checked = $("input[type=checkbox]:checked").length;
          if(!checked) {
            alert("El usuario debe de tener al menos 1 rol asignado.");
            return false;
          }
        });
    });
</script>
@endsection