@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Recuperar contraseña</h2>
    </div>
</div>

<hr>

<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
        </div>
        <div class="col-md-4" style="text-align: center">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ url('password/email') }}">
                @csrf

                <label for="email">E-mail</label>

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                    required> @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span> @endif

                <br>

                <button type="submit" class="btn btn-primary">Recuperar contraseña</button>

            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection