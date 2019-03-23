@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Nueva asignación curso: {{ $curso->denominacion}}</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('asignaciones.store') }}">
                @csrf
                <div class="form-group row">
                    <label>Práctica</label>
                    <select class="form-control m-bot15" name="practica_id" id="practica_id" required>
                        <option value="">Seleccione práctica</option>  
                        @foreach($practicas as $tit)
                            <option value="{{ $tit->id }}">{{ $tit->denominacion }}</option>  
                        @endforeach 
                    </select>
                    <br><br>
                    <label>Institución</label>
                    <select class="form-control m-bot15" name="institucion_id" id="institucion_id" disabled required>
                        <option value="">Seleccione institución</option>  
                    </select>
                    <br><br>
                    <label>Tutor Institucional</label>
                    <select class="form-control m-bot15" name="tinstitucional_id" id="tinstitucional_id" disabled required>
                        <option value="">Seleccione tutor institucional</option>  
                    </select>
                    <br><br>
                    <label>Tutor Académico</label>
                    <select class="form-control m-bot15" name="tacademico_id" id="tacademico_id" required>
                        <option value="">Seleccione tutor académico</option>
                        @foreach ($tutoresAcad as $tutorAcad)
                            <option value="{{$tutorAcad->id}}">{{$tutorAcad->apellido1}} {{$tutorAcad->apellido2}}, {{$tutorAcad->name}}</option>    
                        @endforeach
                    </select>
                    <br><br>
                    <label>Alumno</label>
                    <select class="form-control m-bot15" name="alumno_id" id="alumno_id" disabled required>
                        <option value="">Seleccione alumno</option>  
                    </select>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <script>
        jQuery(document).ready(function(){
            $("#practica_id").change(function(){
                if($("#practica_id").val() != "")
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/asignaciones/getInstitucionesTitulacion') }}",
                        data: {practica_id: $('#practica_id').val() },
                        dataType: "json",
                        success: function(data)
                        {
                            $('#institucion_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione institución</option>')
                                .val('');

                            $.each(data, function(key, value) 
                            {
                                $('#institucion_id').append('<option value='+value.id+'>'+value.denominacion+'</option>');
                            });

                            $("#institucion_id").prop("disabled", false);
                        },
                        failure: function () {
                            alert("Failed!");
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/asignaciones/getAlumnosPractica') }}",
                        data: {practica_id: $('#practica_id').val() },
                        dataType: "json",
                        success: function(data)
                        {
                            $('#alumno_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione alumno</option>')
                                .val('');

                            $.each(data, function(key, value) 
                            {
                                $('#alumno_id').append('<option value='+value.id+'>'+ value.apellido1 + " " + value.apellido2 + ", " + value.name + '</option>');
                            });

                            $("#alumno_id").prop("disabled", false);
                        },
                        failure: function () {
                            alert("Failed!");
                        }
                    });
                }
                else
                {
                    $('#institucion_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione institución</option>')
                                .val('');

                    $("#institucion_id").prop("disabled", true);
                    $('#alumno_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione alumno</option>')
                                .val('');

                    $("#alumno_id").prop("disabled", true);
                    $('#tinstitucional_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione tutor institucional</option>')
                                .val('');

                    $("#tinstitucional_id").prop("disabled", true);
                }
            });

            $("#institucion_id").change(function(){
                if($("#institucion_id").val() != "")
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/asignaciones/getTutoresInstitucion') }}",
                        data: { institucion_id: $('#institucion_id').val() },
                        dataType: "json",
                        success: function(data)
                        {
                            $('#tinstitucional_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione tutor institucional</option>')
                                .val('');

                            $.each(data, function(key, value) 
                            {
                                $('#tinstitucional_id').append('<option value='+value.id+'>'+ value.apellido1 + " " + value.apellido2 + ", " + value.name + '</option>');
                            });

                            $("#tinstitucional_id").prop("disabled", false);
                        },
                        failure: function () {
                            alert("Failed!");
                        }
                    });
                }
                else
                {
                    $('#tinstitucional_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Seleccione tutor institucional</option>')
                                .val('');

                    $("#tinstitucional_id").prop("disabled", true);
                }
            });
        });
    </script>
@endsection