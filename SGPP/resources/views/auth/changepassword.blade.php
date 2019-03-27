@extends('layouts.app') 
@section('content')
<div class="container">
    <br>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">

        <div class="col-md-4">
        </div>

        <div class="col-md-4">

            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="control-label">Contraseña actual</label>
                    <input id="current-password" type="password" class="form-control" name="current-password" required> @if($errors->has('current-password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('current-password') }}</strong>
                        </span> @endif
                </div>

                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="control-label">Nueva contraseña</label>
                    <input style="min-width: 100%;" id="new-password" type="password" class="form-control" name="new-password" required>                    @if ($errors->has('new-password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('new-password') }}</strong>
                </span> @endif

                </div>

                <div class="form-group">
                    <label for="new-password-confirm" class="control-label">Confirmar nueva contraseña</label>
                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                </div>

                <div class="form-group" style="text-align:center;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Cambiar contraseña
                    </button>
                </div>
            </form>

        </div>


        <div class="col-md-4">
        </div>

    </div>

</div>
@endsection