@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-md-10">
        <h2>Carga de usuarios</h2>
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
        <div class="col-md-8" style="text-align:center">
            <form method="post" action="{{url('updateExcel')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="excel">
                <br><br>
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
@endsection