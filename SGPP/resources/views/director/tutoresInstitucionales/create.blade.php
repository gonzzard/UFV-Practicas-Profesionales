@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nuevo tutor Institucional</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('tutoresInstitucionales.store') }}">
                @csrf
                <input type="hidden" name="buscado" id="buscado" value="no" />
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
                    <label for="docIdentificacion" class="col-md-4 col-form-label text-md-right">Documento de identificación</label>

                    <div class="col-md-6">
                        <input id="docIdentificacion" type="text" class="form-control{{ $errors->has('docIdentificacion') ? ' is-invalid' : '' }}"
                            name="docIdentificacion" value="{{ old('docIdentificacion') }}" required
                            autofocus maxlength="255"> @if ($errors->has('docIdentificacion'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docIdentificacion') }}</strong>
                                </span> @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                            required maxlength="255"> @if ($errors->has('email'))
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
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Institución</label>
                    <div class="col-md-6">
                    <select class="form-control m-bot15" name="institucion_id" required>
                        <option value="">Seleccione titulación</option>  
                        @foreach($instituciones as $inst)
                            <option value="{{ $inst->id }}">{{ $inst->denominacion }}</option>  
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


<script>
    jQuery(document).ready(function(){
        $('#docIdentificacion').on('input',function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('/tutoresInstitucionales/getUsuarioByDocumento') }}",
                    data: {docIdentificacion: $('#docIdentificacion').val() },
                    dataType: "json",
                    success: function(data)
                    {
                        if ($.trim(data)){   
                            $.each(data, function(key, value) 
                            {
                                $("#name").val(value.name);
                                $("#apellido1").val(value.apellido1);
                                $("#apellido2").val(value.apellido2);
                                $("#email").val(value.email);
                                $("#password-confirm").val("");
                                $("#password").val("");

                                $("#name").prop("disabled", true);
                                $("#apellido1").prop("disabled", true);
                                $("#apellido2").prop("disabled", true);
                                $("#email").prop("disabled", true);
                                $("#password-confirm").prop("disabled", true);
                                $("#password").prop("disabled", true);

                                $('#password-confirm').prop('required', false);
                                $('#password').prop('required', false);

                                $("#buscado").val("si");
                            }); 
                        }
                        else
                        {   
                            $("#name").val("");
                            $("#apellido1").val("");
                            $("#apellido2").val("");
                            $("#email").val("");
                            $("#password-confirm").val("");
                            $("#password").val("");

                            $("#name").prop("disabled", false);
                            $("#apellido1").prop("disabled", false);
                            $("#apellido2").prop("disabled", false);
                            $("#email").prop("disabled", false);
                            $("#password-confirm").prop("disabled", false);
                            $("#password").prop("disabled", false);

                            $('#password-confirm').prop('required', true);
                            $('#password').prop('required', true);

                            $("#buscado").val("no");
                        }

                    },
                    failure: function () {
                        alert("Error en la comunicación.");
                    }
                });
        });
    });

</script>
@endsection