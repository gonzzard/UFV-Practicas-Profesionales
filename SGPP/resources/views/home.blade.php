@extends('layouts.app') 
@section('content') @if (!Auth::guest() && Auth::user()->hasRole('Administrador'))

<div class="row">
    <div class="col-md-12">
        <h2>Panel del administrador</h2>
    </div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('cursoacad') }}" class=" link-card " title="Cursos académicos">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fa fa-calendar fa-2x" style="margin-left: 1px;" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3 rebosar">Curso Académico</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('directores') }}" class=" link-card " title="Directores de grado">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fas fa-graduation-cap fa-2x" style="margin-left: -1px;" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3 rebosar">Directores</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('titulaciones') }}" class=" link-card " title="Titulaciones">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fa fa-certificate fa-2x"  aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3 rebosar">Titulaciones</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('user') }}" class=" link-card " title="Usuarios">
                    <br>
                    <div class="card border-warning mx-sm-1 p-3 ufv-card">
                        <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                            <span class="fa fa-users fa-2x" style="margin-left: -2px;" aria-hidden="true"></span>
                        </div>
                        <div class="texto-card">
                            <h4 class="text-center mt-3 rebosar">Usuarios</h4>
                            <h1 class="text-center mt-2"></h1>
                        </div>
                    </div>
                </a>
        </div>
    </div>
</div>

@endif @if (!Auth::guest() && Auth::user()->hasRole('Director de Grado') && isset($director)) @if (!Auth::guest() && Auth::user()->hasRole('Administrador'))
<br><br> @endif

<div class="row">
    <div class="col-md-12">
        <h2>Panel del director</h2>
    </div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('tutoresAcademicos') }}" class=" link-card " title="Tutores académicos">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fas fa-chalkboard-teacher fa-2x" style="margin-left: -3px;" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3 rebosar">Tutores</h4>
                        <h4 class="text-center mt-3 rebosar">Académicos</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('tutoresInstitucionales') }}" class=" link-card " title="Tutores institucionales">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-user-tie fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3 rebosar">Tutores</h4>
                        <h4 class="text-center mt-3 rebosar">Institucionales</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('instituciones') }}" class=" link-card " title="Instituciones colaboradoras">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fas fa-building fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3 rebosar">Instituciones</h4>
                        <h4 class="text-center mt-3 rebosar">Colaboradoras</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('practicas') }}" class=" link-card " title="Planificación de prácticas profesionales">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-briefcase fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3 rebosar">Planificación</h4>
                        <h4 class="text-center mt-3 rebosar">Prácticas</h4>
                        <h1 class="text-center mt-2"></h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-3 ">
            <a href="{{ url('asignaciones') }}" class=" link-card " title="Asignaciones de prácticas profesionales">
                    <br>
                    <div class="card border-warning mx-sm-1 p-3 ufv-card">
                        <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                            <span class="fa fa-users fa-2x" style="margin-left: -2px;" aria-hidden="true"></span>
                        </div>
                        <div class="texto-card">
                            <h4 class="text-center mt-3 rebosar">Asignaciones de</h4>
                            <h4 class="text-center mt-3 rebosar">Prácticas</h4>
                            <h1 class="text-center mt-2"></h1>
                        </div>
                    </div>
                </a>

        </div>
        <div class="col-md-3 ">
            <a href="{{ url('descargaExcel') }}" class=" link-card " title="Tutores académicos">
                        <br>
                        <div class="card border-warning mx-sm-1 p-3 ufv-card">
                            <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                                <span class="fas fa-chalkboard-teacher fa-2x" style="margin-left: -3px;" aria-hidden="true"></span>
                            </div>
                            <div class="texto-card">
                                <h4 class="text-center mt-3 rebosar">Descarga de</h4>
                                <h4 class="text-center mt-3 rebosar">reportes</h4>
                                <h1 class="text-center mt-2"></h1>
                            </div>
                        </div>
                    </a>
        </div>
        <div class="col-md-3 ">
        </div>
    </div>
</div>

@endif @if (!Auth::guest() && Auth::user()->hasRole('Alumno')) @if (!Auth::guest() && (Auth::user()->hasRole('Administrador')
|| Auth::user()->hasRole('Director de Grado')))
<br><br> @endif

<div class="row">
    <div class="col-md-12">
        <h2>Panel del alumno</h2>
    </div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('practicasAlumno') }}" class=" link-card ">
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
            <a href="{{ url('certificados') }}" class=" link-card ">
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

@endif @if (!Auth::guest() && Auth::user()->hasRole('Tutor Académico')) @if (!Auth::guest() && (Auth::user()->hasRole('Alumno')
|| Auth::user()->hasRole('Director de Grado')))
<br><br> @endif

<div class="row">
    <div class="col-md-12">
        <h2>Panel del tutor académico</h2>
    </div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('tutorAcad/practicasTutorizadas') }}" class=" link-card ">
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
            <a href="{{ url('evaluaciones') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Evaluaciones</h4>
                        @if($evaluacionesPendientes == 0)
                            <h4 class="text-center mt-3">-</h4>
                        @else
                            <h4 class="text-center mt-3 text-danger">{{$evaluacionesPendientes}}</h4>
                        @endif
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

@endif @if (!Auth::guest() && Auth::user()->hasRole('Tutor Institucional')) @if (!Auth::guest() && (Auth::user()->hasRole('Administrador')
|| Auth::user()->hasRole('Director de Grado') || Auth::user()->hasRole('Tutor Académico')))
<br><br> @endif

<div class="row">
    <div class="col-md-12">
        <h2>Panel del tutor institucional</h2>
    </div>
</div>

<hr>
<br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 ">
            <a href="{{ url('tutorInst/practicasTutorizadas') }}" class=" link-card ">
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
            <a href="{{ url('evidenciasPorValidar') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Evidencias</h4>
                        @if($evidenciasPendientes == 0)
                            <h4 class="text-center mt-3">-</h4>
                        @else
                            <h4 class="text-center mt-3 text-danger">{{$evidenciasPendientes}}</h4>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="{{ url('evaluacionesTutorInst') }}" class=" link-card ">
                <br>
                <div class="card border-warning mx-sm-1 p-3 ufv-card">
                    <div class="card border-warning shadow text-warning p-4 my-card ufv-card">
                        <span class="fa fa-certificate fa-2x" aria-hidden="true"></span>
                    </div>
                    <div class="texto-card">
                        <h4 class="text-center mt-3">Evaluaciones</h4>
                        @if($evaluacionesTutorInstPendientes == 0)
                            <h4 class="text-center mt-3">-</h4>
                        @else
                            <h4 class="text-center mt-3 text-danger">{{$evaluacionesTutorInstPendientes}}</h4>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 ">
        </div>
    </div>
</div>

@endif
@endsection