@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Cambio de institución</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<hr>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('director.asignaciones.cambioInstStore', $asignacion->id) }}">
                @csrf
                <div class="form-group row">
                    <label>Práctica</label>
                    <select class="form-control m-bot15" name="practica_id" id="practica_id" required disabled>
                        <option value="{{ $asignacion->practica->id }}">{{ $asignacion->practica->denominacion }}</option>  
                    </select>
                    <br><br>
                    <label>Institución</label>
                    <select class="form-control m-bot15" name="institucion_id" id="institucion_id" required>
                        <option value="">Seleccione institución</option>  
                        @foreach ($instituciones as $Inst)
                            @if($Inst->id == $asignacion->tutorInst->institucion_id)
                                <option value="{{$Inst->id}}" selected>{{$Inst->denominacion}}</option>    
                            @else
                                <option value="{{$Inst->id}}">{{$Inst->denominacion}}</option>    
                            @endif
                        @endforeach
                    </select>
                    <br><br>
                    <label>Tutor Institucional</label>
                    <select class="form-control m-bot15" name="tinstitucional_id" id="tinstitucional_id" required>
                        <option value="">Seleccione tutor institucional</option>  
                        @foreach ($tutoresInst as $tutorInst)
                            @if($tutorInst->id == $asignacion->tutorInst->id)
                                <option value="{{$tutorInst->id}}" selected>{{$tutorInst->apellido1}} {{$tutorInst->apellido2}}, {{$tutorInst->name}}</option>    
                            @else
                                <option value="{{$tutorInst->id}}">{{$tutorInst->apellido1}} {{$tutorInst->apellido2}}, {{$tutorInst->name}}</option>    
                            @endif
                        @endforeach
                    </select>
                    <br><br>
                    <label>Tutor Académico</label>
                    <select class="form-control m-bot15" name="tacademico_id" id="tacademico_id" required>
                        <option value="">Seleccione tutor académico</option>
                        @foreach ($tutoresAcad as $tutorAcad)
                            @if($tutorAcad->id == $asignacion->tutorAcad->id)
                                <option value="{{$tutorAcad->id}}" selected>{{$tutorAcad->apellido1}} {{$tutorAcad->apellido2}}, {{$tutorAcad->name}}</option>    
                            @else
                                <option value="{{$tutorAcad->id}}">{{$tutorAcad->apellido1}} {{$tutorAcad->apellido2}}, {{$tutorAcad->name}}</option>    
                            @endif
                        @endforeach
                    </select>
                    <br><br>
                    <label>Alumno</label>
                    <select class="form-control m-bot15" name="alumno_id" id="alumno_id" disabled required>
                        <option value="{{ $asignacion->alumno->id }}">{{ $asignacion->alumno->apellido1 }} {{ $asignacion->alumno->apellido2 }}, {{ $asignacion->alumno->name }}</option>  
                    </select>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button id="btn-submit" type="submit" class="btn btn-primary" disabled>
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
        var oldInst = "";
        var oldTutorInst = "";
        var oldTutorAcad = "";

        jQuery(document).ready(function(){
            oldInst = $("#institucion_id").val();
            oldTutorInst = $("#tinstitucional_id").val();
            oldTutorAcad = $("#tacademico_id").val();

            $("#tacademico_id").change(function(){

                if(oldInst == $("#institucion_id").val()
                        && oldTutorAcad == $("#tacademico_id").val()
                        && oldTutorInst == $("#tinstitucional_id").val())
                    {
                        $("#btn-submit").prop("disabled", true);
                    }
                    else
                    {
                        $("#btn-submit").prop("disabled", false);
                    }
            });

            $("#tinstitucional_id").change(function(){
                if(oldInst == $("#institucion_id").val()
                        && oldTutorAcad == $("#tacademico_id").val() 
                        && oldTutorInst == $("#tinstitucional_id").val())
                    {
                        $("#btn-submit").prop("disabled", true);
                    }
                    else
                    {
                        $("#btn-submit").prop("disabled", false);
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

                if(oldInst == $("#institucion_id").val() 
                        && oldTutorAcad == $("#tacademico_id").val()
                        && oldTutorInst == $("#tinstitucional_id").val())
                    {
                        $("#btn-submit").prop("disabled", true);
                    }
                    else
                    {
                        $("#btn-submit").prop("disabled", false);
                    }
            });
        });
    </script>
@endsection