@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Datos tutor académico</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}"
                            required autofocus maxlength="255" disabled> @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido1" class="col-md-4 col-form-label text-md-right">Apellido 1</label>

                    <div class="col-md-6">
                        <input id="apellido1" type="text" class="form-control{{ $errors->has('apellido1') ? ' is-invalid' : '' }}" name="apellido1"
                            value="{{ $user->apellido1 }}" required autofocus maxlength="255" disabled> @if ($errors->has('apellido1'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellido1') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="apellido2" class="col-md-4 col-form-label text-md-right">Apellido 2</label>

                    <div class="col-md-6">
                        <input id="apellido2" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2"
                            value="{{ $user->apellido2 }}" required autofocus maxlength="255" disabled> @if ($errors->has('apellido2'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellido2') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="docIdentificacion" class="col-md-4 col-form-label text-md-right">Documento de identificación</label>

                    <div class="col-md-6">
                        <input id="docIdentificacion" type="text" class="form-control{{ $errors->has('docIdentificacion') ? ' is-invalid' : '' }}"
                            name="docIdentificacion" value="{{ $user->docIdentificacion }}" onblur="validaNif(this)" required
                            autofocus maxlength="255" disabled> @if ($errors->has('docIdentificacion'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docIdentificacion') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}"
                            required maxlength="255" disabled> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection