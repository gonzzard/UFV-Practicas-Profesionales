@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Editar usuario</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<br>

<a href="{{ url('user') }}" class="btn btn-primary">
    <i class="fa fa-arrow-left"></i> Volver
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf {{ method_field('PATCH') }}

                <div class="form-group row">
                    <label for="docIdentificacion" class="col-md-4 col-form-label text-md-right">Documento</label>

                    <div class="col-md-6">
                        <input id="docIdentificacion" type="text" class="form-control{{ $errors->has('docIdentificacion') ? ' is-invalid' : '' }}"
                            title="Solo son válidos DNIs sin letra" name="docIdentificacion" value="{{ $user->docIdentificacion }}"
                            required pattern="[0-9]{8}" autofocus title="Solo números del documento de identificación.">                        @if ($errors->has('docIdentificacion'))
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('docIdentificacion') }}</strong>
                                        </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}"
                            required autofocus> @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-md-4 col-form-label text-md-right">Apellido 1</label>

                    <div class="col-md-6">
                        <input id="apellido1" type="text" class="form-control{{ $errors->has('apellido1') ? ' is-invalid' : '' }}" name="apellido1"
                            value="{{ $user->apellido1 }}" required autofocus> @if ($errors->has('apellido1'))
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('apellido1') }}</strong>
                                        </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido2" class="col-md-4 col-form-label text-md-right">Apellido 2</label>

                    <div class="col-md-6">
                        <input id="apellido2" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2"
                            value="{{ $user->apellido2 }}" required autofocus> @if ($errors->has('apellido2'))
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('apellido2') }}</strong>
                                            </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}"
                            required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">Roles</label>
                    <div class="col-md-6">
                        @foreach($allRoles as $role)
                        <div class="form-check">
                            @if ($user->roles->contains($role['id']))
                            <input type="checkbox" name="role[]" value="{{ $role['id'] }}" checked>
                            <label class="form-check-label" for="role[]">{{ $role['nombre'] }}</label><br> @else
                            <input type="checkbox" name="role[]" value="{{ $role['id'] }}">
                            <label class="form-check-label" for="role[]">{{ $role['nombre'] }}</label><br> @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row">
                    <div class="custom-control custom-switch"  style="left: 45%; position: relative;">
                        <br>
                        <input type="checkbox" class="custom-control-input" id="activo" name="activo" @if($user->activo == 1)checked=checked @endif>
                        <label class="custom-control-label" for="activo">Activo</label>
                    </div>
                </div>

                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4" style="text-align:center;">
                        <button type="submit" class="btn btn-primary" id="checkBtn" name="checkBtn">
                                        <i class="fa fa-save"></i> Guardar
                                </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
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