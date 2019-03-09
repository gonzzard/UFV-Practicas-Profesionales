@extends('layouts.app') 
@section('content')

<h2>Panel del administrador</h2>
<hr>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('cursoacad') }}" class=" link-card ">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fa fa-calendar fa-2x" style="margin-left: 1px;" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3">Curso Académico</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('directores') }}" class=" link-card ">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fas fa-graduation-cap fa-2x" style="margin-left: -1px;" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3">Directores</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('titulaciones') }}" class=" link-card ">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fa fa-certificate fa-2x"  aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3">Titulaciones</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                    <br>
                    <div class="card border-warning mx-sm-1 p-3 ufv-card">
                        <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                            <span class="fa fa-users fa-2x" style="margin-left: -2px;" aria-hidden="true"></span>
                        </div>
                        <div class="texto-card">
                            <h4 class="text-center mt-3">Usuarios</h4>
                            <h1 class="text-center mt-2"></h1>
                        </div>
                    </div>
                </a>
        </div>
    </div>
</div>

<br><br>

<h2>Panel del director</h2>
<hr>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('tutoresAcademicos') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Tutores</h4>
                        <h4 class="text-center mt-3">Académicos</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('tutoresInstitucionales') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Tutores</h4>
                        <h4 class="text-center mt-3">Institucionales</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3">Instituciones</h4>
                                <h4 class="text-center mt-3">Colaboradoras</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3">Planificación</h4>
                                <h4 class="text-center mt-3">Prácticas</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                    <br>
                    <div class="card border-warning mx-sm-1 p-3 ufv-card">
                        <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                            <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                        </div>
                        <div class="texto-card">
                            <h4 class="text-center mt-3">Asignaciones de</h4>
                            <h4 class="text-center mt-3">Prácticas</h4>
                            <h1 class="text-center mt-2"></h1>
                        </div>
                    </div>
                </a>

        </div>
        <div class="col-md-3 ">
        </div>
        <div class="col-md-3 ">
        </div>
    </div>
</div>

<br><br>

<h2>Panel del alumno</h2>
<hr>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Prácticas</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Certificados</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
        </div>
        <div class="col-md-3 ">
        </div>
    </div>
</div>

<br><br>

<h2>Panel del tutor académico</h2>
<hr>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Prácticas</h4>
                        <h4 class="text-center mt-3">Tutorizadas</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Evaluaciones</h4>
                        <h4 class="text-center mt-3">-</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
        </div>
        <div class="col-md-3 ">
        </div>
    </div>
</div>

<br><br>

<h2>Panel del tutor institucional</h2>
<hr>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Prácticas</h4>
                        <h4 class="text-center mt-3">Tutorizadas</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Evidencias</h4>
                        <h4 class="text-center mt-3">-</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
        </div>
        <div class="col-md-3 ">
        </div>
    </div>
</div>
@endsection