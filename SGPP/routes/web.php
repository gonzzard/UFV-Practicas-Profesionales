<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

// ADMINISTRADOR
Route::resource('user', 'UserController')->middleware(['auth', 'role:Administrador']);
Route::resource('cursoacad', 'CursoAcadController')->middleware(['auth', 'role:Administrador']);
Route::resource('directores', 'DirectorController')->middleware(['auth', 'role:Administrador']);
Route::resource('titulaciones', 'TitulacionController')->middleware(['auth', 'role:Administrador']);

Route::get('cargaExcel', 'UserController@cargaExcel')->name('admin.user.cargaExcel')->middleware(['auth', 'role:Administrador']);
Route::post('updateExcel', 'UserController@updateExcel')->name('admin.user.updateExcel')->middleware(['auth', 'role:Administrador']);

// DIRECTOR GRADO
Route::resource('instituciones', 'InstitucionController')->middleware(['auth', 'role:Director de Grado']);

Route::post('/tutoresInstitucionales/getUsuarioByDocumento', 'TutoresInstitucionalesController@getUsuarioByDocumento');
Route::resource('tutoresInstitucionales', 'TutoresInstitucionalesController')->middleware(['auth', 'role:Director de Grado']);

Route::post('/tutoresAcademicos/getUsuarioByDocumento', 'TutoresAcademicosController@getUsuarioByDocumento');
Route::resource('tutoresAcademicos', 'TutoresAcademicosController')->middleware(['auth', 'role:Director de Grado']);

Route::resource('practicas', 'PracticaController')->middleware(['auth', 'role:Director de Grado']);

Route::post('/asignaciones/getInstitucionesTitulacion', 'AsignacionController@getInstitucionesTitulacion');
Route::post('/asignaciones/getTutoresInstitucion', 'AsignacionController@getTutoresInstitucion');
Route::post('/asignaciones/getTutorAcademico', 'AsignacionController@getTutorAcademico');
Route::post('/asignaciones/getAlumnosPractica', 'AsignacionController@getAlumnosPractica');
Route::resource('asignaciones', 'AsignacionController', ['except' => ['show']])->middleware(['auth', 'role:Director de Grado']);
Route::get('asignaciones/{id}', 'AsignacionController@show')->name('director.asignaciones.show')->middleware(['auth', 'role:Director de Grado']);
Route::get('asignaciones/cambioInst/{id}', 'AsignacionController@cambioInst')->name('director.asignaciones.cambioInst')->middleware(['auth', 'role:Director de Grado']);
Route::post('asignaciones/cambioInst/{id}', 'AsignacionController@cambioInstStore')->name('director.asignaciones.cambioInstStore')->middleware(['auth', 'role:Director de Grado']);

Route::get('valoracionInstitucion/{id}', 'AsignacionController@valoracionInstitucion')->name('director.asignaciones.valoracionInstitucion')->middleware(['auth', 'role:Director de Grado']);
Route::get('valoracionPracticas/{id}', 'AsignacionController@valoracionPracticas')->name('director.asignaciones.valoracionPracticas')->middleware(['auth', 'role:Director de Grado']);

Route::get('asignaciones/evidencias/{id}', 'AsignacionController@evidencias')->name('director.asignaciones.evidencias')->middleware(['auth', 'role:Director de Grado']);
Route::get('asignaciones/evidencia/{id}', 'AsignacionController@evidencia')->name('director.asignaciones.evidencia')->middleware(['auth', 'role:Director de Grado']);

Route::get('criteriosEvaluacion/{id}', ['as' => 'criteriosEvaluacion.index', 'uses' => 'CriterioController@index'])->middleware(['auth', 'role:Director de Grado']);
Route::get('criteriosEvaluacion/{id}/create', ['as' => 'criteriosEvaluacion.create', 'uses' => 'CriterioController@create'])->middleware(['auth', 'role:Director de Grado']);
Route::get('criteriosEvaluacion/{id}/show', ['as' => 'criteriosEvaluacion.show', 'uses' => 'CriterioController@show'])->middleware(['auth', 'role:Director de Grado']);
Route::resource('criteriosEvaluacion', 'CriterioController', ['except' => ['index', 'create', 'show']])->middleware(['auth', 'role:Director de Grado']);

Route::get('criteriosEncuesta/{id}', ['as' => 'criteriosEncuesta.index', 'uses' => 'CriterioEncuestaPracticaController@index'])->middleware(['auth', 'role:Director de Grado']);
Route::get('criteriosEncuesta/{id}/create', ['as' => 'criteriosEncuesta.create', 'uses' => 'CriterioEncuestaPracticaController@create'])->middleware(['auth', 'role:Director de Grado']);
Route::get('criteriosEncuesta/{id}/show', ['as' => 'criteriosEncuesta.show', 'uses' => 'CriterioEncuestaPracticaController@show'])->middleware(['auth', 'role:Director de Grado']);
Route::resource('criteriosEncuesta', 'CriterioEncuestaPracticaController', ['except' => ['index', 'create', 'show']])->middleware(['auth', 'role:Director de Grado']);

// ALUMNO
Route::get('/practicasAlumno', 'PracticasAlumnoController@index')->middleware(['auth', 'role:Alumno']);
Route::get('/evidencias/{id}', 'PracticasAlumnoController@evidencias')->name('alumno.practicasAlumno.evidencias')->middleware(['auth', 'role:Alumno']);
Route::get('/evidencias/create/{id}', 'PracticasAlumnoController@createEvidencia')->name('alumno.practicasAlumno.createEvidencia')->middleware(['auth', 'role:Alumno']);
Route::post('/evidencias/store', 'PracticasAlumnoController@storeEvidencia')->name('alumno.practicasAlumno.store')->middleware(['auth', 'role:Alumno']);
Route::get('/evidencias/show/{id}', 'PracticasAlumnoController@showEvidencia')->name('alumno.practicasAlumno.showEvidencia')->middleware(['auth', 'role:Alumno']);
Route::get('/valorarInstitucion/{id}', 'PracticasAlumnoController@valorarInstitucion')->name('alumno.practicasAlumno.valorarInstitucion')->middleware(['auth', 'role:Alumno']);
Route::post('/valorarInstitucion/{id}', 'PracticasAlumnoController@valorarInstitucionStore')->name('alumno.practicasAlumno.valorarInstitucion')->middleware(['auth', 'role:Alumno']);
Route::get('/certificados', 'PracticasAlumnoController@certificados')->name('alumno.certificados.index')->middleware(['auth', 'role:Alumno']);
Route::get('/certificados/{id}', 'PracticasAlumnoController@descargaCertificado')->name('alumno.certificados.descarga')->middleware(['auth', 'role:Alumno']);

// TUTOR ACAD
Route::get('/evaluaciones', 'EvaluarPracticasController@evaluacionesPendientes')->name('tutorAcad.evaluaciones.index')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/evaluaciones/{id}', 'EvaluarPracticasController@evaluarPractica')->name('tutorAcad.evaluaciones.evaluarPractica')->middleware(['auth', 'role:Tutor Académico']);
Route::post('/evaluaciones/{id}', 'EvaluarPracticasController@evaluacionStore')->name('tutorAcad.evaluaciones.evaluarPracticaStore')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/evidenciasPractica/{id}', 'EvaluarPracticasController@evidencias')->name('tutorAcad.evaluaciones.evidencias')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/tutorAcad/practicasTutorizadas/', 'EvaluarPracticasController@practicas')->name('tutorAcad.practicas.index')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/tutorAcad/practicasTutorizadas/evidencias/{id}', 'EvaluarPracticasController@evidenciasPractica')->name('tutorAcad.practicas.evidencias')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/tutorAcad/practicasTutorizadas/evidencia/{id}', 'EvaluarPracticasController@evidenciaPractica')->name('tutorAcad.practicas.evidencia')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/tutorAcad/practicasTutorizadas/show/{id}', 'EvaluarPracticasController@show')->name('tutorAcad.practicas.show')->middleware(['auth', 'role:Tutor Académico']);
Route::get('/tutorAcad/valoracionPracticas/{id}', 'EvaluarPracticasController@valoracionPracticas')->name('tutorAcad.practicas.valoracionPracticas')->middleware(['auth', 'role:Tutor Académico']);

// TUTOR INST
Route::get('/evidenciasPorValidar', 'EvidenciasPorValidarController@index')->name('tutorInst.practicasAlumno.evidencias')->middleware(['auth', 'role:Tutor Institucional']);
Route::get('/evidenciasPorValidar/{id}', 'EvidenciasPorValidarController@evidencia')->name('tutorInst.practicasAlumno.evidencias')->middleware(['auth', 'role:Tutor Institucional']);
Route::post('/evidenciasPorValidar/{id}', 'EvidenciasPorValidarController@validarEvidencia')->name('tutorInst.practicasAlumno.evidencias')->middleware(['auth', 'role:Tutor Institucional']);
Route::get('/tutorInst/practicasTutorizadas/', 'EvidenciasPorValidarController@practicas')->name('tutorInst.practicas.index')->middleware(['auth', 'role:Tutor Institucional']);
Route::get('/tutorInst/practicasTutorizadas/evidencias/{id}', 'EvidenciasPorValidarController@evidenciasPractica')->name('tutorInst.practicas.evidencias')->middleware(['auth', 'role:Tutor Institucional']);
Route::get('/tutorInst/practicasTutorizadas/evidencia/{id}', 'EvidenciasPorValidarController@evidenciaPractica')->name('tutorInst.practicas.evidencia')->middleware(['auth', 'role:Tutor Institucional']);
Route::get('/tutorInst/practicasTutorizadas/show/{id}', 'EvidenciasPorValidarController@show')->name('tutorInst.practicas.show')->middleware(['auth', 'role:Tutor Institucional']);

Route::get('/evaluacionesTutorInst', 'EvaluacionesTutorInstPendientes@index')->name('tutorInst.evaluaciones.evaluaciones')->middleware(['auth', 'role:Tutor Institucional']);
Route::get('/evaluacionesTutorInst/{id}', 'EvaluacionesTutorInstPendientes@evaluacion')->name('tutorInst.evaluaciones.evaluacion')->middleware(['auth', 'role:Tutor Institucional']);
Route::post('/evaluacionesTutorInst/{id}', 'EvaluacionesTutorInstPendientes@evaluarPracticas')->name('tutorInst.evaluaciones.evaluacion')->middleware(['auth', 'role:Tutor Institucional']);

Route::get('descargaExcel', 'ReportesController@reporteAsignaciones');