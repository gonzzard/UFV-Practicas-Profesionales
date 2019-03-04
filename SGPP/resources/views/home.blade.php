@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-users" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center  mt-3">Usuarios</h4>
                        <h1 class="text-center  mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ url('user') }}" class="custom-card">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-users" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center  mt-3">Usuarios</h4>
                        <h1 class="text-center  mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ url('user') }}" class="custom-card">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-users" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center  mt-3">Usuarios</h4>
                        <h1 class="text-center  mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ url('user') }}" class="custom-card">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-users" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center  mt-3">Usuarios</h4>
                        <h1 class="text-center  mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection